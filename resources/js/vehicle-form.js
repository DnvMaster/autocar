import {ClassicEditor,Essentials,Paragraph,Bold,Italic,Link,List,Heading } from 'ckeditor5';
import 'ckeditor5/ckeditor5.css';
document.addEventListener('DOMContentLoaded', () => {
    // CKEditor
    const description = document.querySelector('#description');
    if (description) {
        ClassicEditor
        .create(description, {
            licenseKey: 'GPL',
            plugins: [Essentials,Paragraph,Bold,Italic,Link,List,Heading],
            toolbar: ['undo','redo','|','heading','|','bold','italic','|','link','|','bulletedList','numberedList'],
            language: 'ru',
        })
        .then(editor => {
            console.log('CKEditor успешно загружен.');
            window.vehicleDescriptionEditor = editor;
        })
        .catch(error => {
            console.error('Ошибка CKEditor:', error);
        });
    }
    // Preview фотографий
    const imageInput = document.querySelector('#vehicle-images');
    const imagePreview = document.querySelector('#vehicle-images-preview');
    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', () => {
            imagePreview.innerHTML = '';
            const files = Array.from(imageInput.files);
            files.forEach((file) => {
                if (!file.type.startsWith('image/')) {
                    return;
                }
                const wrapper = document.createElement('div');
                wrapper.className = 'relative overflow-hidden rounded-xl border border-gray-200 bg-gray-50 aspect-video';
                const image = document.createElement('img');
                image.src = URL.createObjectURL(file);
                image.alt = file.name;
                image.className = 'h-full w-full object-cover';
                wrapper.appendChild(image);
                imagePreview.appendChild(wrapper);
            });
        });
    }
});
