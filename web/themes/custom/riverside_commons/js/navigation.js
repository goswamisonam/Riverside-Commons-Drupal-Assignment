(function (Drupal, once) {
  Drupal.behaviors.riversideNavigation = {
    attach(context) {
      once('riverside-navigation', '.nav-toggle', context).forEach((button) => {
        const nav = document.getElementById(button.getAttribute('aria-controls'));

        button.addEventListener('click', () => {
          const expanded = button.getAttribute('aria-expanded') === 'true';
          button.setAttribute('aria-expanded', String(!expanded));
          nav.classList.toggle('is-open', !expanded);
        });

        document.addEventListener('keydown', (event) => {
          if (event.key === 'Escape' && nav.classList.contains('is-open')) {
            nav.classList.remove('is-open');
            button.setAttribute('aria-expanded', 'false');
            button.focus();
          }
        });
      });
    },
  };
})(Drupal, once);
