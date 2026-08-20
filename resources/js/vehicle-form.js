import {
    ClassicEditor,
    Essentials,
    Paragraph,
    Bold,
    Italic,
    Link,
    List,
    Heading,
} from 'ckeditor5';

import 'ckeditor5/ckeditor5.css';

document.addEventListener('DOMContentLoaded', () => {
    const description = document.querySelector('#description');

    if (!description) {
        console.warn('CKEditor: textarea #description не найден.');
        return;
    }

    ClassicEditor
        .create(description, {
            licenseKey: 'GPL',
            plugins: [
                Essentials,
                Paragraph,
                Bold,
                Italic,
                Link,
                List,
                Heading,
            ],

            toolbar: [
                'undo',
                'redo',
                '|',
                'heading',
                '|',
                'bold',
                'italic',
                '|',
                'link',
                '|',
                'bulletedList',
                'numberedList',
            ],

            language: 'ru',
        })
        .then(editor => {
            console.log('CKEditor успешно загружен.');

            window.vehicleDescriptionEditor = editor;
        })
        .catch(error => {
            console.error('Ошибка CKEditor:', error);
        });
});
