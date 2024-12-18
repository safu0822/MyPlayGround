document.addEventListener("DOMContentLoaded", function () {
  const heading = document.querySelectorAll("h2, h3");
  const sideWrapper = document.querySelector(".side_wrapper");

  const createTocSideArea = document.createElement("ol");
  createTocSideArea.className = "side_table_of_contents";

  const sideHeader = document.createElement("p");
  sideHeader.className = "side_header";
  sideHeader.innerText = "目次";

  let j = 0;
  while (j < heading.length) {
    if (heading[j].tagName === "H2") {
      const sidebarTocTitleH2 = document.createElement("li");
      sidebarTocTitleH2.className = "sidebar_toc_title_h2";
      sidebarTocTitleH2.innerHTML = `<a class="toc_link" href="#${j}">${heading[j].innerText}</a>`;
      createTocSideArea.appendChild(sidebarTocTitleH2);
    } else if (heading[j].tagName === "H3") {
      const sidebarTocTitleH3 = document.createElement("li");
      sidebarTocTitleH3.className = "sidebar_toc_title_h3";
      sidebarTocTitleH3.innerHTML = `<a class="toc_link" href="#${j}">${heading[j].innerText}</a>`;
      createTocSideArea.appendChild(sidebarTocTitleH3);
    }
    j++;
  }

  sideWrapper.appendChild(sideHeader);
  sideWrapper.appendChild(createTocSideArea);
});
