// const slideContainer = document.querySelector('.container');
// const slide = document.querySelector('.img_epingler');
// const nextBtn = document.getElementById('next-btn');
// const prevBtn = document.getElementById('prev-btn');
// const interval = 2000;

// let slides = document.querySelectorAll('.slides');
// let index = 1;
// let slideId;
// const slideWidth = slides[index].clientWidth;

// slide.style.transform = `translateX(${(-slideWidth * index) +195}px)`;

// console.log(slides);

// const startSlide = () => {
//   slideId = setInterval(() => {
//     moveToNextSlide();
//   }, interval);
// };

// const getSlides = () => document.querySelectorAll('.slides');

// const moveToNextSlide = () => {

//   slides = getSlides();
//   console.log(index);
//   if(index >  slides.length -3 ) index= 0; index++;
//   if(index === slides.length-3 ) index =0; index++;
//   slide.style.transition = '.7s ease-out';
//   slide.style.transform = `translateX(${(-slideWidth * index) +195}px)`;
// };

// const moveToPreviousSlide = () => {
//   console.log(index);
//   if (index <= 2) index =slides.length -1;
//   index--;
//   slide.style.transition = '.7s ease-out';
//   slide.style.transform = `translateX(${(-slideWidth * index)+195}px)`;
// };



// slideContainer.addEventListener('mouseover', () => {
//   clearInterval(slideId);
// });

// slideContainer.addEventListener('mouseleave', startSlide);
// index=0;
// nextBtn.addEventListener('click', moveToNextSlide);
// prevBtn.addEventListener('click', moveToPreviousSlide);
// startSlide();
