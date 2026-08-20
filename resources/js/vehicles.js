document.addEventListener('DOMContentLoaded', () => {

    const form = document.querySelector('[data-vehicles-filter-form]');
    if(!form) {
        return;
    }

    const selects = form.querySelectorAll('select');
    selects.forEach((select) => {
        select.addEventListener('change', () => {
            form.submit();
        });
    });

    const imageInput = document.querySelector('#vehicle-images');
    const imageLabel = document.querySelector('#vehicle-images-label');
    if (imageInput && imageLabel) {
        imageInput.addEventListener('change', () => {
            const count = imageInput.files.length;
            if (count === 0) {
                imageLabel.textContent = 'Можно выбрать несколько фотографий';
                return;
            }
            if (count === 1) {
                imageLabel.textContent = 'Выбрана 1 фотография';
                return;
            }
         imageLabel.textContent = `Выбрано фотографий: ${count}`;
        });
    }

});
