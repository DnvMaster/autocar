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
});
