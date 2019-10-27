<template>
    <div>
        <div class="card mb-2">
            <div class="card-body">
                <slot name="before-editor"></slot>
                <div class="editor">
                    <editor-content class="editor__content" :editor="editor" />
                </div>
                <slot name="after-editor"></slot>
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
                required: true,
                type: String,
                default: () => {
                    return ''
                }
            },
            title: {
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
        },
        created() {
            this.editor.setOptions({
                editable: false,
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
