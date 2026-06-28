document.addEventListener("DOMContentLoaded", function () {
  const header = document.querySelector(
    "#head, #live-head, #sub_1head, #sub_1_1head, #sub_2head, #airhead, .mytop, #product1, #product2, .logintop, .memtop, .moditop, .ctop, .nontop, .otop"
  );

  if (!header) return;

  let openButton = header.querySelector(".hm");

  if (openButton) {
    openButton.classList.add("site-menu-button");
    openButton.type = "button";
    openButton.setAttribute("aria-label", "메뉴 열기");
    openButton.setAttribute("aria-expanded", "false");
    if (!openButton.querySelector("span")) {
      openButton.appendChild(document.createElement("span"));
    }
  } else {
    openButton = document.createElement("button");
    openButton.type = "button";
    openButton.className = "site-menu-button";
    openButton.setAttribute("aria-label", "메뉴 열기");
    openButton.setAttribute("aria-expanded", "false");
    openButton.innerHTML = "<span></span>";
    header.appendChild(openButton);
  }

  let drawer = document.querySelector("#menu");
  let overlay = document.querySelector(".modal_back");

  if (!drawer) {
    drawer = document.createElement("nav");
    drawer.className = "site-menu-drawer";
    drawer.setAttribute("aria-label", "전체 메뉴");
    drawer.innerHTML = `
      <div class="site-menu-head">
        <a class="site-menu-logo" href="main.html">WIN<span>IX</span></a>
        <button class="site-menu-close" type="button" aria-label="메뉴 닫기">×</button>
      </div>

      <div class="site-menu-search">
        <label class="site-menu-search-label">
          <span class="sr-only">검색어</span>
          <input type="search" placeholder="검색어를 입력하세요.">
          <span class="site-menu-search-icon" aria-hidden="true"></span>
        </label>
      </div>

      <ul class="site-menu-list">
        <li>
          <a href="#" class="site-menu-toggle">회사소개</a>
          <ul class="site-submenu">
            <li><a href="#">기업소개</a></li>
            <li><a href="#">연혁</a></li>
            <li><a href="#">CI 스토리</a></li>
          </ul>
        </li>
        <li>
          <a href="#" class="site-menu-toggle">제품</a>
          <ul class="site-submenu">
            <li><a href="sub.html">공기청정기</a></li>
            <li><a href="#">가습기</a></li>
            <li><a href="#">건조기</a></li>
            <li><a href="#">제습기</a></li>
            <li><a href="#">온풍기</a></li>
          </ul>
        </li>
        <li>
          <a href="#" class="site-menu-toggle">소모품</a>
          <ul class="site-submenu">
            <li><a href="#">공기청정기</a></li>
            <li><a href="#">가습기</a></li>
            <li><a href="#">건조기</a></li>
            <li><a href="#">제습기</a></li>
          </ul>
        </li>
        <li>
          <a href="#" class="site-menu-toggle">서비스</a>
          <ul class="site-submenu">
            <li><a href="#">케어서비스</a></li>
            <li><a href="#">에어컨설치</a></li>
            <li><a href="#">서비스센터 찾기</a></li>
          </ul>
        </li>
        <li>
          <a href="#" class="site-menu-toggle">고객지원</a>
          <ul class="site-submenu">
            <li><a href="#">구매/서비스 FAQ</a></li>
            <li><a href="#">공지사항</a></li>
            <li><a href="#">A/S 접수</a></li>
          </ul>
        </li>
        <li>
          <a href="#" class="site-menu-toggle">이벤트</a>
          <ul class="site-submenu">
            <li><a href="#">전체 이벤트</a></li>
            <li><a href="#">타임딜</a></li>
          </ul>
        </li>
        <li><a href="mypage.php">마이페이지</a></li>
      </ul>`;
    document.body.appendChild(drawer);
  }

  if (!overlay) {
    overlay = document.createElement("div");
    overlay.className = "site-menu-overlay";
    document.body.appendChild(overlay);
  }

  const closeButton = drawer.querySelector(".site-menu-close, .arrow");

  function openMenu() {
    drawer.classList.add("is-open");
    overlay.classList.add("is-open");
    document.body.classList.add("site-menu-lock");
    openButton.setAttribute("aria-expanded", "true");
  }

  function closeMenu() {
    drawer.classList.remove("is-open");
    overlay.classList.remove("is-open");
    document.body.classList.remove("site-menu-lock");
    openButton.setAttribute("aria-expanded", "false");
  }

  openButton.addEventListener("click", openMenu);
  if (closeButton) closeButton.addEventListener("click", closeMenu);
  overlay.addEventListener("click", closeMenu);

  drawer.querySelectorAll(".site-menu-toggle, .mm2 > li > a").forEach(function (link) {
    const submenu = link.nextElementSibling;
    if (!submenu) return;

    link.addEventListener("click", function (event) {
      event.preventDefault();
      submenu.classList.toggle("is-open");
      submenu.style.display = submenu.classList.contains("is-open") ? "block" : "none";
    });
  });

  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") closeMenu();
  });
});
