<?php

namespace Tests\Feature;

use App\Models\All_themes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InstallationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест редиректа на страницу установки, если CMS еще не устанволена
     */
    public function testRedirectToInstallationPage()
    {
        /** @var bool $shouldSetCmsInstalledToTrue Нужно ли установить переменную в env равной true после тестирования */
        $shouldSetCmsInstalledToTrue = false;

        // region Создание условий "неустановленной" cms
        if (env('CMS_INSTALLED', false) != false) {
            $shouldSetCmsInstalledToTrue = true;
            \App\Library\Common\Env::set('CMS_INSTALLED', 'false');
        }
        // endregion

        $response = $this->get('/');

        $response->assertRedirect('/installation');

        // если до теста было установлено значение true - возвращаем его
        if ($shouldSetCmsInstalledToTrue == true) {
            \App\Library\Common\Env::set('CMS_INSTALLED', 'true');
        }
    }

    /**
     * Тест входа на гр=лавную страницу при установленной CMS. В этом случае мы не получаем редирект.
     */
    public function testVisitInstalledCms()
    {
        /** @var bool $shouldSetCmsInstalledToTrue Нужно ли установить переменную в env равной false после тестирования */
        $shouldSetCmsInstalledToFalse = false;

        // region Создание условий "неустановленной" cms
        if (env('CMS_INSTALLED', false) != true) {
            $shouldSetCmsInstalledToFalse = true;
            \App\Library\Common\Env::set('CMS_INSTALLED', 'true');
        }
        // endregion

        $response = $this->get('/');

        $response->assertOk();

        // если до теста было установлено значение true - возвращаем его
        if ($shouldSetCmsInstalledToFalse == true) {
            \App\Library\Common\Env::set('CMS_INSTALLED', 'false');
        }
    }
}
