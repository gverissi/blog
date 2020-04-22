document.addEventListener('DOMContentLoaded',function(){

	// let vw = window.innerWidth
	// let trueVw = document.documentElement.clientWidth
	// let sbWidth = vw - trueVw
	// //console.log(sbWidth)
	// //document.documentElement.style.setProperty('--scrollbar-width', (window.innerWidth - document.documentElement.clientWidth) + "px")
	// document.documentElement.style.setProperty('--scrollbar-width', sbWidth)

	// navbar.classList.remove("sticky");
	// div_header_hidden.classList.remove("show");
	// div_header_hidden.classList.add("hide");
	myFunction()

	window.onscroll = function () { myFunction() };
	function myFunction() {
		let sticky = div_header_img.offsetHeight;
		//console.log(sticky);
		if (window.pageYOffset > sticky) {
			navbar.classList.add("sticky");
			div_header_hidden.classList.remove("hide");
			div_header_hidden.classList.add("show");
		} else {
			navbar.classList.remove("sticky");
			div_header_hidden.classList.remove("show");
			div_header_hidden.classList.add("hide");
		}
	}
})