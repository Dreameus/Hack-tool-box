document.addEventListener('DOMContentLoaded', function() {
    // Обработка форм
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formId = this.id;
            const resultsDiv = document.getElementById(formId.replace('Form', 'Results'));
            resultsDiv.innerHTML = '<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Загрузка...</span></div></div>';
            
            const formData = new FormData(this);
            
            fetch(this.action || formId.replace('Form', '.php'), {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                resultsDiv.innerHTML = data;
            })
            .catch(error => {
                resultsDiv.innerHTML = `<div class="alert alert-danger">Ошибка: ${error.message}</div>`;
            });
        });
    });
    
    // Инициализация вкладок
    const triggerTabList = document.querySelectorAll('#myTab a');
    triggerTabList.forEach(triggerEl => {
        const tabTrigger = new bootstrap.Tab(triggerEl);
        triggerEl.addEventListener('click', event => {
            event.preventDefault();
            tabTrigger.show();
        });
    });
});
