(function () {
  "use strict";

  let forms = document.querySelectorAll('.php-email-form');

  forms.forEach(function (form) {

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      let action = form.getAttribute('action');

      let loading = form.querySelector('.loading');
      let error = form.querySelector('.error-message');
      let sent = form.querySelector('.sent-message');

      loading.style.display = "block";
      error.style.display = "none";
      sent.style.display = "none";

      let formData = new FormData(form);

      fetch(action, {
        method: "POST",
        body: formData
      })

      .then(res => res.text())
      .then(data => {

        loading.style.display = "none";

        if (data.trim() === "OK") {
          sent.style.display = "block";
          form.reset();
        }
        else {
          error.innerHTML = data;
          error.style.display = "block";
        }
      })

      .catch(() => {
        loading.style.display = "none";
        error.innerHTML = "Server error. Please try again later.";
        error.style.display = "block";
      });

    });

  });

})();
