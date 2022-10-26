let position = 0;
let slidesToShow = 1;
const slidesToScroll = 1;
const container = document.querySelector(".slider-container");
const track = document.querySelector(".slider-track");
const addForms = document.querySelectorAll(".form-bg");
const btnPrev = document.querySelector(".btn-prev");
const btnNext = document.querySelector(".btn-next");
const items = document.querySelectorAll(".slider-item");
const goBack = document.querySelector(".go-back");
const itemsCount = items.length;
let itemWidth = container.clientWidth / slidesToShow;
let movePosition = slidesToScroll * itemWidth;

const checkWidth = () => {
  let clientWidth = container.clientWidth;
  if (clientWidth <= 414) {
    slidesToShow = 1;
  } else if (clientWidth <= 820) {
    slidesToShow = 2;
  } else if (clientWidth <= 912) {
    slidesToShow = 3;
  } else {
    slidesToShow = 4;
  }
}



const setWidth = () => {
  itemWidth = container.clientWidth / slidesToShow;
  movePosition = slidesToScroll * itemWidth;
  items.forEach((item) => {
  if (itemsCount < slidesToShow) {
    item.style.width = `${itemWidth}%`;
  } else {
    item.style.minWidth = `${itemWidth - 1}px`;
  }});
}

window.addEventListener("resize", function() {
  checkWidth();
  setWidth();
});

btnNext.addEventListener('click', () => {
  const itemsLeft = itemsCount - (Math.abs(position) + slidesToShow * itemWidth) / itemWidth;

  position -= itemsLeft >= slidesToScroll ? movePosition : itemsLeft * itemWidth;

  setPosition();
  checkBtns();
});

btnPrev.addEventListener('click', () => {
  const itemsLeft = itemsCount - Math.abs(position) / itemWidth;

  position += itemsLeft >= slidesToScroll ? movePosition : itemsLeft * itemWidth;

  setPosition();
  checkBtns();
});

const setPosition = () => {
  track.style.transform = `translateX(${position}px)`;
  addForms.forEach(addForm => {
    addForm.style.transform = `translateX(${-position}px)`;
  });
  goBack.style.transform = `left(${-position}px)`;
};

const checkBtns = () => {
  btnPrev.hidden = position === 0;
  btnNext.hidden = position <= -(itemsCount - slidesToShow) * itemWidth;
}

checkWidth();
setWidth();

checkBtns();