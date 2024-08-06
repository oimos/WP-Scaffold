import '../sass/style.scss';

import $ from 'cash-dom';

// Use the Cash library's ready function to ensure the DOM is fully loaded
// $(function () {
//   // Select the menu toggle button using Cash
//   var menuToggle = $('.menu-toggle');
//   console.log(menuToggle);

//   // Attach a click event handler to the toggle button
//   menuToggle.on('click', function () {
//     console.log('click');
//     // Toggle the 'toggled' class on the main navigation
//     $('#site-navigation').toggleClass('toggled');
//     console.log($('#site-navigation').hasClass('toggled'));
//   });
// });

$(function () {
  var menuToggle = $('.menu-toggle');
  var siteNavigation = $('#site-navigation');
  var menuList = $('ul', siteNavigation);

  menuToggle.on('click', function () {
    // Toggle class to apply CSS transitions
    siteNavigation.toggleClass('toggled');

    // Check the new state after the class toggle
    if (siteNavigation.hasClass('toggled')) {
      // If the menu is now open, set max-height to a value that can cover the menu content
      menuList.css('max-height', menuList.get(0).scrollHeight + 'px');
    } else {
      // If the menu is now closed, reset max-height after transitions have completed
      setTimeout(function () {
        if (!siteNavigation.hasClass('toggled')) {
          menuList.css('max-height', '0');
        }
      }, 300); // This delay should match the duration of the CSS transitions
    }
  });
});



$(function () {
  var lastScrollTop = 0; // 最後のスクロール位置を保存する変数
  var siteHeader = $('#masthead'); // ヘッダー要素のIDまたはクラスを指定

  $(window).on('scroll', function () {
    var st = window.pageYOffset || document.documentElement.scrollTop;

    // トップから80pxの範囲内ではナビゲーションを常に表示
    if (st <= 80) {
      siteHeader.removeClass('nav-up').addClass('nav-down');
    } else {
      if (st > lastScrollTop) {
        // 下にスクロールしている時
        siteHeader.removeClass('nav-down').addClass('nav-up');
      } else {
        // 上にスクロールしている時
        siteHeader.removeClass('nav-up').addClass('nav-down');
      }
    }
    lastScrollTop = st <= 0 ? 0 : st; // ネガティブなスクロール値を防ぐ
  });

});



