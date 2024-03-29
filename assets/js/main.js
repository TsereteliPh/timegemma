"use strict";

function get_siblings(elem) {
	// for collecting siblings
	let siblings = [];
	// if no parent, return no sibling
	if (!elem.parentNode) {
		return siblings;
	}
	// first child of the parent node
	let sibling = elem.parentNode.firstChild;
	// collecting siblings
	while (sibling) {
		if (sibling.nodeType === 1 && sibling !== elem) {
			siblings.push(sibling);
		}
		sibling = sibling.nextSibling;
	}
	return siblings;
}

function slideDown(elem) {
	elem.style.maxHeight = `${elem.scrollHeight}px`;
}

function slideToggle(elem) {
	if (elem.offsetHeight === 0) {
		elem.style.maxHeight = `${elem.scrollHeight}px`;
	} else {
		elem.style.maxHeight = 0;
	}
}

function setHeaderScrollClass() {
	const header = document.querySelector(".header");

	window.addEventListener("scroll", function () {
		if (window.scrollY >= header.offsetHeight) {
			header.classList.add("scroll");
		} else {
			header.classList.remove("scroll");
		}
	});
}

function setTelMask() {
	const phoneInputs = document.querySelectorAll("input[type='tel']");

	phoneInputs.forEach(input => {
		input.setAttribute('inputmode', 'numeric');

		input.addEventListener("keydown", function (e) {
			input.value = phoneNumberFormatter(input.value);
		})

		input.addEventListener("focus", function (e) {
            if (!input.value) {
				input.value = '+';
			}
        })

		input.addEventListener("blur", function (e) {
            if (input.value === '+') {
                input.value = '';
            }
        })
	});

	function phoneNumberFormatter(value) {
		if (!value) return value;

		const phoneNumber = value.replace(/[^\d]/g, '');
		if (phoneNumber.length < 3) return '+' + phoneNumber;
		if (phoneNumber.length < 6) {
			return `+${phoneNumber.slice(0, 2)} ${phoneNumber.slice(2)}`;
		}

		return `+${phoneNumber.slice(0, 2)} ${phoneNumber.slice(2, 5)} ${phoneNumber.slice(5)}`;
	}
}

function sendForm() {
	document.querySelectorAll("form[name]").forEach(function (form) {

		if (form.name === 'checkout' ) return;

		form.addEventListener("submit", function (e) {
			e.preventDefault();
			const form = this;
			form.classList.add('loader');
			let formData = new FormData(form);

			if (!form.name === 'login' || !form.name === 'registeration') {
				const formName = form.name;
				const fileInput = form.querySelector("input[type=file]");

				formData.append("action", "send_mail");

				if (formName) {
					formData.append("form_name", formName);
				} else {
					return;
				}

				if (fileInput) {
					Array.from(fileInput.files).forEach((file, key) => {
						formData.append(key.toString(), file);
					});
				}

				const response = fetch(adem_ajax.url, {
					method: "POST",
					body: formData,
				})
				.then((response) => response.text())
				.then((data) => {
					form.classList.remove('loader');
					Fancybox.close(true);
					form.reset();
					if (!form.classList.contains("checkout")) {
						setTimeout(function () {
							Fancybox.show([
								{
									src: "#success",
									type: "inline",
								},
							]);
						}, 100);
					}
				})
				.catch((error) => {
					console.error("Error:", error);
				});
			} else if (form.name === 'login') {
				formData.append("action", "login");

				const response = fetch(adem_ajax.url, {
					method: "POST",
					body: formData
				})
				.then((response) => response.json())
				.then((data) => {
					form.classList.remove('loader');
					if (data.status == 'success') {
						Fancybox.close(true);
						location.reload();
					} else {
						form.classList.add('invalid');
						if (data.message) {
							form.querySelector('.js-error').textContent = data.message;
						}
					}
				})
				.catch((error) => {
					console.error("Error:", error);
				});
			} else if (form.name === 'registeration') {
				formData.append('action', 'registeration');

				const response = fetch(adem_ajax.url, {
					method: "POST",
					body: formData
				})
				.then((response) => response.json())
				.then((data) => {
					form.classList.remove('loader');
					if (data.status == 'success') {
						Fancybox.close(true);
						location.reload();
					} else {
						form.classList.add('invalid');
						if (data.message) {
							form.querySelector('.js-error').textContent = data.message;
						}
					}
				})
				.catch((error) => {
					console.error("Error:", error);
				});
			}
		});
	});
}

function setFileName() {
	const fileInputs = document.querySelectorAll("input[type=file]");
	if (fileInputs) {
		fileInputs.forEach(function (input) {
			input.addEventListener("change", function (e) {
				e.target.nextElementSibling.textContent = e.target.files[0].name;
			});
		});
	}
}

function tabs() {
	const tabsLists = document.querySelectorAll(".js-tabs");
	if (tabsLists) {
		tabsLists.forEach(function (tabsList) {
			bindUIFunctions(tabsList);
		});
	}

	function bindUIFunctions(tabsList) {
		tabsList.addEventListener("click", function (e) {
			const tabItem = e.target.closest("li");
			if (tabItem.classList.contains("active")) {
				toggleMobileMenu(tabItem);
			}
			if (!tabItem.classList.contains("active") && e.target !== tabsList) {
				changeTab(tabItem);
			}
		});
	}

	function changeTab(tabItem) {
		let tabItems;
		let tabContainer;
		let activeTabClass = tabItem.dataset.class;

		if (activeTabClass) {
			tabItems = document.querySelectorAll("." + tabItem.dataset.tab);
			tabContainer = document.querySelector("." + tabItem.dataset.tab).parentNode.parentNode;
		} else {
			tabContainer = document.querySelector("#" + tabItem.dataset.tab);
		}

		tabItem.classList.add("active");
		get_siblings(tabItem).forEach(function (tab) {
			tab.classList.remove("active");
		});

		if (activeTabClass) {
			tabContainer.classList.add("observer-trigger");
			tabItems.forEach(item => {
				if (item.classList.contains(activeTabClass)) {
					item.classList.add("active");
				} else {
					item.classList.remove("active");
				}
			});
		} else {
			tabContainer.classList.add("active");
			get_siblings(tabContainer).forEach(function (tab_container) {
				tab_container.classList.remove("active");
			});
		}

		tabItem.parentNode.classList.remove("open");
	}

	function toggleMobileMenu(tabItem) {
		tabItem.parentNode.classList.toggle("open");
	}
}

function changeInputQuantity(form, dispatch = false) {
	const formEl = document.querySelector(form);
	if (formEl) {
		formEl.addEventListener('click', function (e) {
			if (e.target.classList.contains('quantity__btn')) {
				let input = e.target.closest('.quantity').querySelector('.quantity__input');
				let val = parseInt(input.value);
				let min = parseInt(input.getAttribute('min'));
				let max = parseInt(input.getAttribute('max'));
				let step = parseInt(input.getAttribute('step'));

				if (e.target.classList.contains('quantity__btn--add')) {
					if (max && (max <= val)) {
						input.value = max;
					} else {
						input.value = val + step;
					}
				} else {
					if ((min || min == 0) && (min >= val - step)) {
						input.value = min;
					} else if (val > 1) {
						input.value = val - step;
					}
				}

				const changeQuantityInput = new Event('change', {bubbles: true, cancelable: true});
				input.dispatchEvent(changeQuantityInput);
			}
		});
	}
}

//Ajax

function showMorePosts() {
	const show_more_btn = document.querySelector(".js-show-more");

	if (!show_more_btn) return;

	show_more_btn.addEventListener("click", function (e) {
		e.stopImmediatePropagation();
		const container = document.querySelector(".js-show-more-container");
		this.classList.add('loader');

		const response = fetch(adem_ajax.url, {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded;charset=UTF-8",
			},
			body: new URLSearchParams({
				action: "load_more",
				query: posts,
				page: current_page,
			}),
		})
			.then((response) => response.text())
			.then((data) => {
				this.classList.remove('loader');
				container.insertAdjacentHTML("beforeend", data);
				current_page++;
				if (current_page === max_pages) this.remove();
			})
			.catch((error) => {
				console.error("Error:", error);
			});
	});
}

function wcAddToCart() {
	const form = document.querySelector('.product__cart');

	if (form) {
		const quantityInput = form.querySelector('.qty');
		let update_cart;

		quantityInput.addEventListener('change', function (e) {
			const input = this;

			if (update_cart != null) clearTimeout(update_cart);

			update_cart = setTimeout(function () {
				input.closest('.product__cart').querySelector('.btn').click();
			}, 1000);
		});

		form.addEventListener('submit', function (e) {
			e.preventDefault();
			const form = this;
			this.classList.add('loader');
			let formData = new FormData(this);
			formData.append('action', 'wc_add_to_cart');

			const response = fetch(adem_ajax.url, {
				method: 'POST',
				body: formData
			})
				.then(response => response.json())
				.then(data => {
					this.classList.remove('loader');
					if (data.count > 0) {
						this.classList.add('in-cart');
					} else {
						this.classList.remove('in-cart');
						quantityInput.value = 1;
					}
					let counter = document.querySelector('#header-cart-counter');
					counter.innerHTML = data.count;
					if (data.countAll > 0) {
						counter.classList.add('active');
					} else {
						counter.classList.remove('active');
					}
				})
				.catch((error) => {
					console.error('Error:', error);
				});
		});
	}
}

function favorites() {
	const favBtns = document.querySelectorAll('.btn-fav');
	const favCounter = document.querySelector('.header__favorites-counter');

	if (!favBtns) return;

	favBtns.forEach(btn => {
		btn.addEventListener('click', function () {
			this.setAttribute('disabled', true);
			this.classList.add('btn-fav--loading');

			if (!this.classList.contains('active')) {
				const response = fetch(adem_ajax.url, {
					method: "POST",
					headers: {
						"Content-Type": "application/x-www-form-urlencoded;charset=UTF-8",
					},
					body: new URLSearchParams({
						action: "add_to_favorite",
						id: this.dataset.id,
						user: this.dataset.user
					}),
				})
				.then((response) => response.json())
				.then((data) => {
					this.classList.remove('btn-fav--loading');
					this.removeAttribute('disabled');
					if (data.status === 'success') {
						favCounter.classList.add('active');
						favCounter.textContent = data.count;
						favBtns.forEach(btn => {
							if (btn.dataset.id === this.dataset.id) {
								btn.classList.add('active');
							}
						});
					}
				})
				.catch((error) => {
					console.error("Error:", error);
				});
			} else if (this.classList.contains('active')) {
				const response = fetch(adem_ajax.url, {
					method: "POST",
					headers: {
						"Content-Type": "application/x-www-form-urlencoded;charset=UTF-8",
					},
					body: new URLSearchParams({
						action: "remove_from_favorite",
						id: this.dataset.id,
						user: this.dataset.user
					}),
				})
				.then((response) => response.json())
				.then((data) => {
					this.classList.remove('btn-fav--loading');
					this.removeAttribute('disabled');
					if (data.status === 'success') {
						favCounter.textContent = data;
						if (data.count === 0) favCounter.classList.remove('active');
						favBtns.forEach(btn => {
							if (btn.dataset.id === this.dataset.id) {
								btn.classList.remove('active');
							}
						});
					}
				})
				.catch((error) => {
					console.error("Error:", error);
				});
			}
		})
	});
}

document.addEventListener("DOMContentLoaded", function () {
	setHeaderScrollClass();

	setFileName();

	sendForm();

	setTelMask();

	tabs();

	showMorePosts();

	changeInputQuantity('.product__cart');

	wcAddToCart();

	favorites();
});

//Fancybox

try {
	Fancybox.bind("[data-fancybox]", {
		animated: false,
	});

	Fancybox.bind('[data-src="#order-calc"]', {
		defaultDisplay: "block",
		dragToClose: false,
	});
} catch (error) {
	console.log(error);
}

//Swiper

//Custom progressbar

const customProgressbar = function(slider, elem) {
	let progressbar = slider.el.querySelector(elem);
	if (!progressbar) progressbar = slider.el.parentNode.querySelector(elem);
	if (!progressbar) return;
	let progressbarCounter = progressbar.querySelector('.slider-controls__counter');

	let activeSlide = slider.activeIndex + 1;
	if (slider.params.slidesPerView > 1) activeSlide = slider.activeIndex + slider.params.slidesPerView;

	let amount = 0;
	slider.slides.forEach(slide => {
		if (slide.classList.contains('active')) amount++;
	});
	if (!amount) amount = slider.slides.length;

	let angle = (360 / (amount / slider.params.grid.rows)) * activeSlide;

	let counter;
	if (activeSlide < 10) {
		counter = '0' + activeSlide;
	} else {
		counter = activeSlide;
	}

	progressbarCounter.textContent = counter;
	progressbar.style.setProperty('--progressbar-angle', angle + 'deg');
}

//Слайдер welcome.php

const welcomeSlider = document.querySelector('.welcome__slider');

if (welcomeSlider) {
	let welcomeSwiper = new Swiper(welcomeSlider, {
		slidesPerView: 'auto',
		spaceBetween: 0,
		speed: 1400,
		allowTouchMove: false,
		autoplay: {
			delay: 4000,
		},
		navigation: {
			nextEl: '.slider-controls__next',
			prevEl: '.slider-controls__prev',
		},
		on: {
			afterInit: function() {
				customProgressbar(this, '.slider-controls__progressbar')
			},
			slideChange: function() {
				customProgressbar(this, '.slider-controls__progressbar')
			}
		}
	});
}

//Слайдер blocks/new-releases

const newReleasesSlider = document.querySelector('.new-releases__slider');

if (newReleasesSlider) {
	let newReleasesSwiper = new Swiper(newReleasesSlider, {
		slidesPerView: 1,
		spaceBetween: 20,
		observer: true,
		navigation: {
			nextEl: newReleasesSlider.parentNode.querySelector('.slider-controls__next'),
			prevEl: newReleasesSlider.parentNode.querySelector('.slider-controls__prev'),
		},
		breakpoints: {
			1440: {
				slidesPerView: 4
			},
			992: {
				slidesPerView: 3
			},
			769: {
				slidesPerView: 2
			},
			577: {
				slidesPerView: 2
			}
		},
		on: {
			afterInit: function() {
				customProgressbar(this, '.slider-controls__progressbar');
			},
			slideChange: function() {
				customProgressbar(this, '.slider-controls__progressbar');
			},
			observerUpdate: function() {
				this.update();
				this.slideTo(0);
				customProgressbar(this, '.slider-controls__progressbar');
			}
		}
	});
}

//Слайдер blocks/collecion-slider

const collectionSlider = document.querySelector('.collection-slider');

if (collectionSlider) {
	let collecionSliderWrapper = collectionSlider.querySelector('.collection-slider__slider');

	if (collectionSlider.classList.contains('collection-slider--sorted')) {
		let collectionsSwiper = new Swiper(collecionSliderWrapper, {
			slidesPerView: 1,
			spaceBetween: 25,
			observer: true,
			navigation: {
				nextEl: collecionSliderWrapper.parentNode.querySelector('.slider-controls__next'),
				prevEl: collecionSliderWrapper.parentNode.querySelector('.slider-controls__prev'),
			},
			breakpoints: {
				992: {
					slidesPerView: 2
				}
			},
			on: {
				afterInit: function() {
					customProgressbar(this, '.slider-controls__progressbar');
				},
				slideChange: function() {
					customProgressbar(this, '.slider-controls__progressbar');
				},
				observerUpdate: function() {
					this.update();
					this.slideTo(0);
					customProgressbar(this, '.slider-controls__progressbar');
				}
			}
		});
	} else {
		let sortedCollectionSlider = new Swiper(collecionSliderWrapper, {
			slidesPerView: 1,
			spaceBetween: 25,
			navigation: {
				nextEl: collecionSliderWrapper.parentNode.querySelector('.slider-controls__next'),
				prevEl: collecionSliderWrapper.parentNode.querySelector('.slider-controls__prev'),
			},
			breakpoints: {
				1280: {
					slidesPerView: 3
				},
				769: {
					slidesPerView: 2
				}
			},
			on: {
				afterInit: function() {
					customProgressbar(this, '.slider-controls__progressbar');
				},
				slideChange: function() {
					customProgressbar(this, '.slider-controls__progressbar');
				}
			}
		});
	}
}

//Слайдер blocks/brands

const brandsSlider = document.querySelector('.brands__slider');

if (brandsSlider) {
	let brandssSwiper = new Swiper(brandsSlider, {
		slidesPerView: 2,
		spaceBetween: 30,
		autoplay: {
			delay: 2000,
		},
		speed: 600,
		grid: {
			rows: 6,
			fill: 'row'
		},
		watchOverflow: true,
		navigation: {
			nextEl: brandsSlider.parentNode.querySelector('.slider-controls__next'),
			prevEl: brandsSlider.parentNode.querySelector('.slider-controls__prev'),
		},
		breakpoints: {
			1440: {
				slidesPerView: 3,
				spaceBetween: 60,
				grid: {
					rows: 3
				}
			},
			769: {
				slidesPerView: 3,
				spaceBetween: 60,
				grid: {
					rows: 2
				}
			},
			577: {
				slidesPerView: 4,
				grid: {
					rows: 3
				}
			}
		},
		on: {
			afterInit: function() {
				customProgressbar(this, '.slider-controls__progressbar');
			},
			lock: function() {
				brandsSlider.parentNode.querySelector('.slider-controls').style.display = 'none';
			},
			slideChange: function() {
				customProgressbar(this, '.slider-controls__progressbar');
			},
		}
	});
}

//Слайдер product-image.php

const productGallerySlider = document.querySelector('.product__gallery');

if (productGallerySlider) {
	let productGallerySwiper = new Swiper(productGallerySlider, {
		slidesPerView: 'auto',
		spaceBetween: 60,
		centeredSlides: true,
		navigation: {
			nextEl: '.slider-controls__next',
			prevEl: '.slider-controls__prev',
		},
		pagination: {
			el: '.swiper-pagination',
            clickable: true,
		},
		on: {
			afterInit: function() {
				customProgressbar(this, '.slider-controls__progressbar')
			},
			slideChange: function() {
				customProgressbar(this, '.slider-controls__progressbar')
			}
		},
		breakpoints: {
			577: {
				spaceBetween: 85
			}
		}
	});
}

//Слайдеры .main-slider

const mainSliders = document.querySelectorAll('.main-slider');

if (mainSliders) {
	mainSliders.forEach(slider => {
		let mainSwiper = new Swiper(slider, {
			slidesPerView: 1,
			centeredSlides: true,
			spaceBetween: 30,
			centerInsufficientSlides: true,
			watchOverflow: true,
			navigation: {
				nextEl: '.slider-controls__next',
				prevEl: '.slider-controls__prev',
			},
			on: {
				afterInit: function() {
					customProgressbar(this, '.slider-controls__progressbar', this.params.slidesPerView);
				},
				lock: function() {
					this.el.querySelector('.slider-controls').style.display = 'none';
				},
				slideChange: function() {
					customProgressbar(this, '.slider-controls__progressbar', this.params.slidesPerView)
				}
			},
			breakpoints: {
				1501: {
					slidesPerView: 6,
					centeredSlides: false
				},
				1280: {
					slidesPerView: 5,
					centeredSlides: false
				},
				992: {
					slidesPerView: 4,
					centeredSlides: false
				},
				769: {
					slidesPerView: 3,
					centeredSlides: false
				},
				577: {
					slidesPerView: 2,
					centeredSlides: false
				}
			}
		});
	});
}

// Функционал шапки сайта

document.addEventListener("DOMContentLoaded", function(e) {
	const header = document.querySelector('.header');

	if (header) {
		const headerBurger = header.querySelector('.header__burger');
		const drop = document.querySelector('.drop');

		headerBurger.onclick = function () {
			this.classList.toggle('active');
			header.classList.toggle('active');
			drop.classList.toggle('active');

			if (drop.classList.contains('active')) {
				document.body.style.overflow = 'hidden';
			} else {
				document.body.style.overflow = 'visible';
			}
		}
	}
})

//Функционал блока .product__list (content-single-product.php)

const productList = document.querySelector('.product__list');

if (productList) {
	const productItemBtns = productList.querySelectorAll('.product__item-button');

	const productItemBtnsClose = () => {
		for (let btn of productItemBtns) {
			btn.classList.remove('active');
			btn.nextElementSibling.style.maxHeight = 0;
		}
	}

	productItemBtns.forEach(btn => {
		btn.addEventListener('click', function() {
			if (this.classList.contains('active')) {
				productItemBtnsClose();
			} else {
				productItemBtnsClose();
				this.classList.add('active');
				slideToggle(this.nextElementSibling);
			}
		})
	});
}

//Функционал меню на страницу аккаунта

const accountNav = document.querySelector('.account__nav');

if (accountNav && window.innerWidth <= 768) {
	const accountNavBtn = accountNav.querySelector('.account__nav-btn');

	accountNavBtn.onclick = () => {
		accountNav.classList.toggle('active');
	}
}

//Функционал модальных окон

const modalLogin = document.querySelector('.modal--login');

if (modalLogin) {
	const loginSwitchBtns = modalLogin.querySelectorAll('.js-tabs li');
	const loginImages = modalLogin.querySelectorAll('.modal__login-img');

	loginSwitchBtns.forEach(btn => {
		btn.addEventListener('click', function() {
			for (let img of loginImages) {
				img.classList.remove('active');
			}

			let activeImg = document.querySelector('.modal__login-img--' + btn.dataset.tab);
			activeImg.classList.add('active');
		})
	});
}
