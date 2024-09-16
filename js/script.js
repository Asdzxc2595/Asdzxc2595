
document.addEventListener("DOMContentLoaded", function() {
    const cardItems = document.querySelectorAll('.card-item-product');
    cardItems.forEach(function(item) {
        item.classList.add('show');
    });
});
//ปุ๋มยอนกลับ
function goBack() {
    window.history.back();
  }
  
//แปลภาษา
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'th'
    }, 'google_translate_element');


    var savedLanguage = localStorage.getItem('selectedLanguage');
    if (savedLanguage) {
        translateLanguage(savedLanguage);
    }
}

function translateLanguage(language) {
    var selectField = document.querySelector('.goog-te-combo');
    if (selectField) {
        selectField.value = language;
        selectField.dispatchEvent(new Event('change'));

        // Save the selected language to local storage
        localStorage.setItem('selectedLanguage', language);
    }
}

function showOriginalText() {
    var selectField = document.querySelector('.goog-te-combo');
    if (selectField) {

        selectField.value = 'auto';
        selectField.dispatchEvent(new Event('change'));

        localStorage.removeItem('selectedLanguage');
    }
}
//ปิดแปลภาษา
// edittor
tinymce.init({
    selector: 'textarea#dtaill_product textarea#banner_description',
    plugins: 'advlist anchor autolink autosave charmap code codesample directionality emoticons fullscreen help image imagetools insertdatetime link lists media nonbreaking pagebreak paste preview print save searchreplace spellchecker table template textcolor visualblocks visualchars wordcount',
    toolbar: 'undo redo | formatselect | fontselect fontsizeselect | bold italic underline strikethrough | forecolor backcolor removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent  | table emoticons charmap | preview fullscreen code',
    menubar: 'file edit view insert format tools table ',
});
