<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\SecurityPolicy\UpdUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecurityPolicy extends Controller
{
    public function index()
    {
        $arResult = User::all(['id', 'login', 'email', 'active'])->first()->paginate(15);
        return view('admin_page.security_policy.users.list_admin_security', compact('arResult'));
    }

    public function displayFormUser()
    {
        $arRoles = Role::all(['id', 'name']);
        return view('admin_page.security_policy.users.form_add_user', compact('arRoles'));
    }

    public function displayRoles()
    {
        $all_roles = Role::paginate(15);
        return view('admin_page.security_policy.roles.list_roles', compact('all_roles', 'arErrors'));
    }

    public function addRole(Request $request)
    {
        $role = new Role();
        $role->name = $request->input('role_name');
        $role->super_user = false;
        $role->save();

        return redirect()->route('all_roles');
    }

    public function actionRole(Request $request)
    {
        //Создаем массив, который будет хранить все checkbox
        $arRequestCheckbox = array();

        $action = $request->input('option_action');
        $input = $request->except(['_token', 'option_action']);

        //Проходим по всему $input с целью разделить checkbox_3 на [checkbox][3]
        //и запихиваем число в заранее созданный массив
        foreach ($input as $key => $value) {
            $pieces = explode("_", $key);

            array_push($arRequestCheckbox, $pieces[1]);
        }

        //Проходимся по всему массиву $arRequestCheckbox
        foreach ($arRequestCheckbox as $key => $value) {
            //Проверяем, назначена кому то это роль?
            //если в запросе у нас '0' элементов в коллекции, то выаолняем действие
            //Иначе ищем название роли и выдаем ошибку юзеру
            $user = Role::find($value)->users;
            if (!$user->count()) {
                Role::destroy($value);
            } else {
                $role = Role::find($value);
                return redirect()->back()->withErrors([
                    'ar' => 'Роль ' . $role->name . ' кому то назначена!'
                ]);
            }
        }

        return redirect()->route('all_roles');
    }

    public function displayDetailRole($id)
    {
        $role = Role::find($id);
        return view('admin_page.security_policy.roles.detail_role', compact('role'));
    }

    public function updateRole(Request $request, $id)
    {
        Role::where('id', $id)->update([
            'name' => $request->input('name_role')
        ]);

        return redirect()->route('all_roles');
    }

    public function addUser(AddUserRequest $request)
    {
        $role = Role::find($request->input('select_role'));
        $role->users()->create([
            'login' => $request->input('login'),
            'email' => $request->input('email'),
            'password' => \Hash::make($request->input('password')),
            'active' => 1,
        ]);

        return redirect()->route('admin_account');
    }

    public function displayDetailUser($id)
    {
        $arUser = User::find($id);
        $arRole = Role::all(['id', 'name']);
        return view('admin_page.security_policy.users.detail_user', compact('arUser', 'arRole'));
    }

    public function updateUser(UpdUser $request,$id)
    {
        //Если юзер хочет изменить пароль
        if($request->input('password_confirmation')!=null)
        {
            //Если пароль совпадает с "password_confirmation"
            if($request->input('password')==$request->input('password_confirmation'))
            {
                User::where('id',$id)->update([
                    'password'=>\Hash::make($request->input('password'))
                ]);
            }else
            {
                return back()->withErrors([
                    'password'=>'Пароли должны совпадать!'
                ]);
            }
        }

        //Если юзер нажал накнопку "Аквтивность"
        if($request->has('checkbox'))
        {
            //Юзер становится активным
            User::where('id',$id)->update([
                'login'=>$request->input('login'),
                'email'=>$request->input('email'),
                'active'=>true
            ]);
        }else{
            //Юзер становится неактивным
            User::where('id',$id)->update([
                'login'=>$request->input('login'),
                'email'=>$request->input('email'),
                'active'=>false
            ]);
        }

        //Лень мне было отслеживать изменение роли юзера,
        //так что при каждом нажатии на кнопку "Сохранить"
        //В промежуточной таблице "role_user", удаляется строка
        //Отвечающая на назначение роли юзеру и заново создается
        //Костыль, но мне лень отслеживать изменение роли юзера
        $user = User::find($id);
        $role_id=Role::find($request->input('select_role'));
        $user->roles()->detach($role_id);
        $user->roles()->sync($role_id);

        return redirect()->route('admin_account');
    }

    public function actionUser(Request $request)
    {
        //Создаем массив, который будет хранить все checkbox
        $arRequestCheckbox = array();

        $action=$request->input('option_action');
        $input = $request->except(['_token','option_action']);

        //Проходим по всему $input с целью разделить checkbox_3 на [checkbox][3]
        //и запихиваем число в заранее созданный массив
        foreach ($input as $key=>$value)
        {
            $pieces = explode("_", $key);
            array_push($arRequestCheckbox,$pieces[1]);
        }

        if($action=='Активировать')
        {
            foreach ($arRequestCheckbox as $arItem)
            {
                User::where('id',$arItem)->update(['active'=>true]);
            }
        }
        elseif($action=='Деактивировать')
        {
            foreach ($arRequestCheckbox as $arItem)
            {
                User::where('id',$arItem)->update(['active'=>false]);
            }
        }
        else
        {
            //Если юзер выбрал из списка "Удалить"
            foreach ($arRequestCheckbox as $arItem)
            {
                //Ищет строку с заданным id в User
                $user = User::find($arItem);

                //Отображает все роли выбранного юзера
                foreach ($user->roles as $value)
                {
                    //Удаляет все строки в связанной таблице, которой что то там
                    $user->roles()->detach($value->id);
                }
                //Удаляет строку в таблице User по заданному id
                User::destroy($arItem);
                dump('удалено!');
            }
        }
        dd();

        return redirect()->route('admin_account');
    }
}
