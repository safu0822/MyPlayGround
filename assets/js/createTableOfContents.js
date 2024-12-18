document.addEventListener("DOMContentLoaded", function () {
  const heading = document.querySelectorAll("h2, h3");

  const createTocArea = document.createElement("ol");
  createTocArea.className = "toc_area";

  const tocWrapper = document.createElement("div");
  tocWrapper.className = "toc_wrapper";

  const tocHeader = document.createElement("p");
  tocHeader.className = "toc_header";
  tocHeader.innerText = "目次";

  tocWrapper.appendChild(tocHeader);
  tocWrapper.appendChild(createTocArea);

  let i = 0;
  while (i < heading.length) {
    if (heading[i].tagName === "H2") {
      const tocTitleH2 = document.createElement("li");
      tocTitleH2.className = "toc_title_h2";
      tocTitleH2.innerHTML = `<a class="toc_link" href="#${i}">${heading[i].innerText}</a>`;
      createTocArea.appendChild(tocTitleH2);
    } else if (heading[i].tagName === "H3") {
      const tocTitleH3 = document.createElement("li");
      tocTitleH3.className = "toc_title_h3";
      tocTitleH3.innerHTML = `<a class="toc_link" href="#${i}">${heading[i].innerText}</a>`;
      createTocArea.appendChild(tocTitleH3);
    }
    const tocLinks = document.createElement("div");
    tocLinks.setAttribute("id", `${i}`);
    tocLinks.setAttribute("class", "anchor");
    heading[i].appendChild(tocLinks);
    i++;
  }

  heading[0].before(tocWrapper);
});
