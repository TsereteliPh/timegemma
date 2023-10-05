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
	[].forEach.call(document.querySelectorAll('[type="tel"]'), function (input) {
		let keyCode;

		function mask(event) {
			event.keyCode && (keyCode = event.keyCode);
			let pos = this.selectionStart;
			if (pos < 3) event.preventDefault();
			let matrix = "+7 (___) ___-__-__",
				i = 0,
				def = matrix.replace(/\D/g, ""),
				val = this.value.replace(/\D/g, ""),
				new_value = matrix.replace(/[_\d]/g, function (a) {
					return i < val.length ? val.charAt(i++) || def.charAt(i) : a;
				});
			i = new_value.indexOf("_");
			if (i != -1) {
				i < 5 && (i = 3);
				new_value = new_value.slice(0, i);
			}
			let reg = matrix
				.substr(0, this.value.length)
				.replace(/_+/g, function (a) {
					return "\\d{1," + a.length + "}";
				})
				.replace(/[+()]/g, "\\$&");
			reg = new RegExp("^" + reg + "$");
			if (
				!reg.test(this.value) ||
				this.value.length < 5 ||
				(keyCode > 47 && keyCode < 58)
			)
				this.value = new_value;
			if (event.type == "blur" && this.value.length < 5) this.value = "";
		}

		input.addEventListener("input", mask, false);
		input.addEventListener("focus", mask, false);
		input.addEventListener("blur", mask, false);
		input.addEventListener("keydown", mask, false);
	});
}

function sendForm() {
	document.querySelectorAll("form[name]").forEach(function (form) {
		form.addEventListener("submit", function (e) {
			e.preventDefault();
			const form = this;
			let formData = new FormData(form);
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
					Fancybox.close(true);
					form.reset();
					setTimeout(function () {
						Fancybox.show([
							{
								src: "#success",
								type: "inline",
							},
						]);
					}, 100);
				})
				.catch((error) => {
					console.error("Error:", error);
				});
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
		const tabContainer = document.querySelector(
			"#" + tabItem.getAttribute("data-tab")
		);

		tabItem.classList.add("active");
		get_siblings(tabItem).forEach(function (tab) {
			tab.classList.remove("active");
		});

		tabContainer.classList.add("active");
		get_siblings(tabContainer).forEach(function (tab_container) {
			tab_container.classList.remove("active");
		});

		tabItem.parentNode.classList.remove("open");
	}

	function toggleMobileMenu(tabItem) {
		tabItem.parentNode.classList.toggle("open");
	}
}

function calcBreadcrumbsPadding() {
	const main = document.querySelector('.main');
	const breadcrumbs = document.querySelector('.breadcrumb');
	let section = document.querySelector('.js-bc-padding');

	let indent;
	window.innerWidth > 1439 ? indent = 124 : indent = 60;

	if (!breadcrumbs) return;

	if (!section) section = main.firstElementChild;

	section.style.marginTop = 0;
	section.style.paddingTop = breadcrumbs.clientHeight + indent + 'px';
}

function changeInputQuantity(form, dispatch = false) {
	if (!form) return;

	document.querySelector(form).addEventListener('click', function (e) {
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

//Ajax

function showMorePosts() {
	const show_more_btn = document.querySelector(".js-show-more");

	if (!show_more_btn) return;

	show_more_btn.addEventListener("click", function (e) {
		e.stopImmediatePropagation();
		const container = document.querySelector(".js-show-more-container");
		this.textContent = "Загрузка...";

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
				this.innerHTML = this.dataset.text;
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

document.addEventListener("DOMContentLoaded", function () {
	setHeaderScrollClass();

	setFileName();

	sendForm();

	setTelMask();

	tabs();

	showMorePosts();

	calcBreadcrumbsPadding();

	changeInputQuantity('.product__cart');

	wcAddToCart();
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
	let progressbarCounter = progressbar.querySelector('.slider-controls__counter');
	let activeSlide = slider.activeIndex + 1;
	let amount = slider.slides.length;
	let angle = (360 / amount) * activeSlide;

	let counter;
	if (activeSlide < 10) {
		counter = '0' + activeSlide;
	} else {
		counter = activeSlide;
	}

	progressbarCounter.textContent = counter;
	progressbar.style.setProperty('--progressbar-angle', angle + 'deg');
}

//Слайдер blocks/rest

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

// Функционал шапки сайта

document.addEventListener("DOMContentLoaded", function(e) {
	const header = document.querySelector('.header');

	if (header) {
		const headerBurger = header.querySelector('.header__burger');

		headerBurger.onclick = function () {
			this.classList.toggle('active');
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
