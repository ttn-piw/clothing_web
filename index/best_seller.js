const list_product = document.querySelector(".container_block .list_product");
const bs_button = document.querySelectorAll(".container_block i");
const firstSlideWidth = list_product.querySelector(".item").offsetWidth;

bs_button.forEach(btn => {
    btn.addEventListener("click", () => {
        if (btn.id === "bs_left") {
            list_product.scrollLeft -= firstSlideWidth;
            // Scroll to the end of the list
            if (list_product.scrollLeft < 0) {
                list_product.scrollLeft = list_product.scrollWidth - list_product.clientWidth;
            }
        } else {
            list_product.scrollLeft += firstSlideWidth;
            // Scroll to the beginning of the list
            if (list_product.scrollLeft + list_product.clientWidth > list_product.scrollWidth - 1) {
                list_product.scrollLeft = 0;
            }
        }
    });
});
