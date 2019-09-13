<template>
    <div>
        <div v-if="!readOnly" class="card mb-2">
            <div class="card-body">
                <div v-if="author">Автор: {{ author }}</div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input v-model="slug" placeholder="Введите ЧПУ статьи. Используйте латиницу и тире (я еще не доделал валидацию)" class="form-control" type="text" id="slug">
                </div>
                <button @click="publish" class="btn btn-primary" :disabled="slug.length === 0">Опубликовать</button>
            </div>
        </div>
        <div v-if="!readOnly" class="card mb-2">
            <div class="card-body">
                <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }" >
                    <div class="menubar">

                        <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.bold() }"
                                @click="commands.bold"
                        >
                            <icon name="bold" />
                        </button>

                        <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.italic() }"
                                @click="commands.italic"
                        >
                            <icon name="italic" />
                        </button>

                        <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.strike() }"
                                @click="commands.strike"
                        >
                            <icon name="strike" />
                        </button>

                        <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.underline() }"
                                @click="commands.underline"
                        >
                            <icon name="underline" />
                        </button>

                        <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.code() }"
                                @click="commands.code"
                        >
                            <icon name="code" />
                        </button>

                        <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.paragraph() }"
                                @click="commands.paragraph"
                        >
                            <icon name="paragraph" />
                        </button>

                        <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.heading({ level: 1 }) }"
                                @click="commands.heading({ level: 1 })"
                        >
                            H1
                        </button>

                        <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.heading({ level: 2 }) }"
                                @click="commands.heading({ level: 2 })"
                        >
                            H2
                        </button>

                        <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.heading({ level: 3 }) }"
                                @click="commands.heading({ level: 3 })"
                        >
                            H3
                        </button>

                        <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.bullet_list() }"
                                @click="commands.bullet_list"
                        >
                            <icon name="ul" />
                        </button>

                        <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.ordered_list() }"
                                @click="commands.ordered_list"
                        >
                            <icon name="ol" />
                        </button>

                        <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.blockquote() }"
                                @click="commands.blockquote"
                        >
                            <icon name="quote" />
                        </button>

                        <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.code_block() }"
                                @click="commands.code_block"
                        >
                            <icon name="code" />
                        </button>

                        <button
                                class="menubar__button"
                                @click="commands.horizontal_rule"
                        >
                            <icon name="hr" />
                        </button>

                        <button
                                class="menubar__button"
                                @click="commands.undo"
                        >
                            <icon name="undo" />
                        </button>

                        <button
                                class="menubar__button"
                                @click="commands.redo"
                        >
                            <icon name="redo" />
                        </button>

                    </div>
                </editor-menu-bar>
            </div>
        </div>
        <div class="card mb-2">
            <div class="card-body">
                <!--<h5 v-if="readOnly" class="card-title">{{ title }}</h5>-->
                <h6 v-if="readOnly" class="card-subtitle mb-2 text-secondary">{{ author }} {{ createdAt }}</h6>
                <div class="editor">
                    <editor-content class="editor__content" :editor="editor" />
                </div>
                <a v-if="readOnly" :href="link" class="card-link">{{ linkName }}</a>
                <a @click="editLinkClickHandler" v-if="readOnly && authUser" :href="linkEdit" class="card-link">Редактировать</a>
                <a @click="deleteLinkClickHandler" v-if="readOnly && authUser" :href="linkDelete" class="card-link">Удалить</a>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import Icon from './Icon'
    import { Editor, EditorContent, EditorMenuBar } from 'tiptap'
    import {
        Blockquote,
        CodeBlock,
        HardBreak,
        Heading,
        HorizontalRule,
        OrderedList,
        BulletList,
        ListItem,
        TodoItem,
        TodoList,
        Bold,
        Code,
        Italic,
        Link,
        Strike,
        Underline,
        History,
        Placeholder,
    } from 'tiptap-extensions'
    import Doc from './Title/Doc'
    import Title from './Title/Title'
    export default {
        components: {
            EditorContent,
            EditorMenuBar,
            Icon,
        },
        data() {
            return {
                slug: '',
                workMode: 'create',
                editor: new Editor({
                    extensions: [
                        new Doc(),
                        new Title(),
                        new Blockquote(),
                        new BulletList(),
                        new CodeBlock(),
                        new HardBreak(),
                        new Heading({ levels: [1, 2, 3] }),
                        new HorizontalRule(),
                        new ListItem(),
                        new OrderedList(),
                        new TodoItem(),
                        new TodoList(),
                        new Link(),
                        new Bold(),
                        new Code(),
                        new Italic(),
                        new Strike(),
                        new Underline(),
                        new History(),
                        new Placeholder({
                            showOnlyCurrent: false,
                            emptyNodeText: node => {
                                if (node.type.name === 'title') {
                                    return 'Заголовок'
                                }
                                return 'Начните писать статью...'
                            },
                        }),
                    ],
                    content: this.content,
                }),
            }
        },
        props: {
            content: {
                required: false,
                type: String,
                default: () => {
                    return ''
                }
            },
            readOnly: {
                required: false,
                type: Boolean,
                default: () => {
                    return false
                }
            },
            title: {
                required: false,
                type: String,
            },
            author: {
                required: false,
                type: String,
            },
            createdAt: {
                required: false,
                type: String,
            },
            link: {
                required: false,
                type: String,
            },
            linkEdit: {
                required: false,
                type: String,
            },
            linkDelete: {
                required: false,
                type: String,
            },
            linkName: {
                required: false,
                type: String,
            },
            storeLink:  {
                required: false,
                type: String,
            },
            oldSlug:  {
                required: false,
                type: String,
            },
            mode:  {
                required: false,
                type: String,
            },
            authUser: {
                required: false,
                type: String,
                default: () => {
                    return null;
                }
            }
        },
        methods: {
            publish () {
                if (this.workMode == 'create') {
                    axios.post(this.storeLink, {
                        slug: this.slug,
                        content: this.editor.getHTML()
                    })
                        .then(response => {
                            if (response.data.result === true) {
                                location.href = response.data.redirectUrl
                            } else {
                                alert('Error')
                            }
                        })
                } else if (this.workMode == 'edit') {
                    axios.put(this.storeLink, {
                        slug: this.slug,
                        content: this.editor.getHTML()
                    })
                        .then(response => {
                            if (response.data.result === true) {
                                location.href = response.data.redirectUrl
                            } else {
                                alert('Error')
                            }
                        })
                }
            },
            editLinkClickHandler () {
                location.href = this.linkEdit
            },
            deleteLinkClickHandler () {
                axios.delete(this.linkDelete)
                    .then(response => {
                        if (response.data.result === true) {
                            location.href = response.data.redirectUrl
                        } else {
                            alert('Error')
                        }
                    })
            },
        },
        created() {
            this.editor.setOptions({
                editable: !this.readOnly,
            });

            if (this.oldSlug) {
                this.slug = this.oldSlug
            }
            if (this.mode) {
                this.workMode = this.mode
            }
        },
        beforeDestroy() {
            this.editor.destroy()
        },
    }
</script>

<style lang="scss">
    .editor *.is-empty:nth-child(1)::before,
    .editor *.is-empty:nth-child(2)::before {
        content: attr(data-empty-text);
        float: left;
        color: #aaa;
        pointer-events: none;
        height: 0;
        font-style: italic;
    }
</style>