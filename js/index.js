// Открытие формы по кнопке "feedback"
document.getElementById('feedback').addEventListener('click', function() {
  document.getElementById('feedback-modal').style.display = 'flex';
});

// Закрытие формы по крестику
document.querySelector('.close').addEventListener('click', function() {
  document.getElementById('feedback-modal').style.display = 'none';
});

// Закрытие при клике вне формы
window.addEventListener('click', function(event) {
  const modal = document.getElementById('feedback-modal');
  if (event.target === modal) {
    modal.style.display = 'none';
  }
});

// Отправка формы (без перезагрузки страницы)
document.getElementById('feedback-form').addEventListener('submit', function(e) {
  e.preventDefault(); // Отменяем стандартную отправку
  
  // Здесь можно добавить AJAX-отправку или просто вывод данных
  const formData = new FormData(this);
  const data = Object.fromEntries(formData.entries());
  fetch("save_data.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log("Ответ сервера:", data);
        alert("Данные успешно отправлены!");
        form.reset(); // Очищаем форму
    })
    .catch(error => {
        console.error("Ошибка:", error);
        alert("Произошла ошибка при отправке данных.");
    });
  
  alert('Сообщение отправлено!');
  
  // Закрываем форму после отправки
  document.getElementById('feedback-modal').style.display = 'none';
  this.reset(); // Очищаем поля
});