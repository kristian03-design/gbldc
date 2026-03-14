const newsData = [
  {
    title:
      "22nd Annual General Assembly of Greater Bulacan Livelihood Development Cooperative - GBLDC",
    desc: "Highlights of the event, featuring key updates, financial reports, and the election of new officers.",
    img: "path/images/event1.jpg",
  },
  {
    title: "GBLDC Team Building",
    desc: "Strengthening teamwork through fun and engaging activities with all departments.",
    img: "path/images/gbldc-teambuilding.jpg",
  },
  {
    title: "Welcoming New Members",
    desc: "Welcoming newly joined cooperative members with orientation and gifts.",
    img: "path/images/event1.jpg",
  },
  {
    title: "Financial Literacy Training",
    desc: "Equipping members with smart money skills.",
    img: "path/images/event1.jpg",
  },
  {
    title: "Community Outreach Program",
    desc: "Serving the barangay together through health and donation drives.",
    img: "path/images/event1.jpg",
  },
  {
    title: "Co-op Tech Upgrade 2025",
    desc: "Digital transformation is underway!",
    img: "path/images/event1.jpg",
  },
  {
    title: "Awards Night Highlights",
    desc: "Recognizing outstanding co-op contributors.",
    img: "path/images/event1.jpg",
  },
];

const itemsPerPage = 6;
let currentPage = 1;
const totalPages = Math.ceil(newsData.length / itemsPerPage);

function renderNewsItems() {
  const container = document.getElementById("news-container");
  container.innerHTML = "";

  const start = (currentPage - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  const items = newsData.slice(start, end);

  items.forEach((item, index) => {
    const globalIndex = start + index;
    const card = document.createElement("div");
    card.className =
      "bg-white rounded-lg overflow-hidden shadow-md cursor-pointer hover:scale-105 transition duration-300 space-y-2 card-animate";
    card.onclick = () => {
      window.location.href = `news-details.html?index=${globalIndex}`;
    };
    card.innerHTML = `
      <img src="${item.img}" alt="${
      item.title
    }" class="w-full h-56 object-cover">
      <div class="p-4">
        <h3 class="text-lg font-semibold">${item.title}</h3>
        <p class="text-sm text-gray-600">${item.desc.substring(0, 80)}...</p>
      </div>
    `;
    container.appendChild(card);
  });

  animateCards();
}

function renderPaginationButtons() {
  const container = document.getElementById("pagination-buttons");
  container.innerHTML = "";

  const createButton = (label, disabled, onClick) => {
    const btn = document.createElement("button");
    btn.textContent = label;
    btn.className = `px-3 py-1 border rounded-md text-sm ${
      disabled
        ? "bg-gray-200 text-gray-500 cursor-not-allowed"
        : "hover:bg-green-100 text-green-600 border-green-600"
    }`;
    if (!disabled) btn.onclick = onClick;
    return btn;
  };

  container.appendChild(createButton("Prev", currentPage === 1, prevPage));

  for (let i = 1; i <= totalPages; i++) {
    const btn = document.createElement("button");
    btn.textContent = i;
    btn.className = `px-3 py-1 rounded-md text-sm ${
      i === currentPage
        ? "bg-green-600 text-white"
        : "bg-white text-green border hover:bg-green-600 hover:text-white"
    }`;
    btn.onclick = () => goToPage(i);
    container.appendChild(btn);
  }

  container.appendChild(createButton("Next", currentPage === totalPages, nextPage));
}

function goToPage(page) {
  if (page < 1 || page > totalPages) return;
  currentPage = page;
  renderNewsItems();
  renderPaginationButtons();
}

function nextPage() {
  if (currentPage < totalPages) {
    currentPage++;
    renderNewsItems();
    renderPaginationButtons();
  }
}

function prevPage() {
  if (currentPage > 1) {
    currentPage--;
    renderNewsItems();
    renderPaginationButtons();
  }
}


function animateCards() {
  const cards = document.querySelectorAll("#news-container > *");
  cards.forEach((card, i) => {
    card.classList.remove("card-animate");
    setTimeout(() => {
      card.classList.add("card-animate");
    }, 80 * i);
  });
}

// Initial render
renderNewsItems();
renderPaginationButtons();
