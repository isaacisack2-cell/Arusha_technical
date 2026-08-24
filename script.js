/* read more vs read less */
const readLess = document.getElementById('readLess');
const readMore = document.getElementById('readMore');
const more = document.getElementById('more');

more.style.display = "none";
readLess.addEventListener('click',()=>{
    more.style.display = "none";
    readLess.innerText = "";
    readMore.innerText = "Read More";
});

readMore.addEventListener('click',()=>{
    more.style.display = "block";
    readMore.innerText = "";
    readLess.innerText = "Read Less";
});

//Toggle mobile menu
const hambugerBtn = document.getElementById('hambugerBtn');
const infoBtn = document.getElementById('infoBtn');
const mobileDrawer = document.getElementById('mobileDrawer');
const infoModel = document.getElementById('infoModel');
const overlay = document.getElementById('overlay');
const closeDrawer = document.getElementById('closeDrawer');
const closeInfo = document.getElementById('closeInfo');

//toggle mobile navigation left
hambugerBtn.addEventListener('click',()=>{
    mobileDrawer.classList.add('active');
    overlay.classList.add('active');
});

//toggle three dot info model right
infoBtn.addEventListener('click',()=>{
    infoModel.classList.add('active');
    overlay.classList.add('active');
});

//close models
const closeAll = ()=>{
    mobileDrawer.classList.remove('active');
    infoModel.classList.remove('active');
    overlay.classList.remove('active');
};

closeDrawer.addEventListener('click',closeAll())
closeInfo.addEventListener('click',closeAll())


//2.AUTO SCROLLING CAROUSEL
const sliderWrapper = document.getElementById('slideWrapper');
const slides = document.querySelectorAll('.slide');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
let currentIndex = 0;
const totalSlides = slides.length;

const updateSliderPosition = ()=>{
    sliderWrapper.style.transform = `translateX(-${currentIndex*100}%)`;
};

const nextSlide = ()=>{
    currentIndex = (currentIndex + 1) % totalSlides;
    console.log(currentIndex);
    updateSliderPosition();
};

const prevSlide = ()=>{
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    updateSliderPosition();
};

//autoscrolling
let autoscroll = setInterval(nextSlide(),3000);

//manual controll
nextBtn.addEventListener('click',()=>{
    nextSlide();
    resetTimer();
})

prevBtn.addEventListener('click',()=>{
    prevSlide();
    resetTimer();
})

const resetTimer = ()=>{
    clearInterval(autoscroll);
    autoscroll = setInterval(nextSlide(),3000);
}