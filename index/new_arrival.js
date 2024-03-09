const list_product_na = document.querySelector(".new_arrival_block .list_product");
const na_button = document.querySelectorAll(".new_arrival_block i");
const firstSlideWidth_na = list_product_na.querySelector(".item").offsetWidth;

na_button.forEach(btn_na => {
    btn_na.addEventListener("click", () => {
        if (btn_na.id === "na_left") {
            list_product_na.scrollLeft -= firstSlideWidth_na;
            // Scroll to the end of the list
            if (list_product_na.scrollLeft < 0) {
                list_product_na.scrollLeft = list_product_na.scrollWidth - list_product_na.clientWidth;
            }
        } else {
            list_product_na.scrollLeft += firstSlideWidth_na;
            // Scroll to the beginning of the list
            if (list_product_na.scrollLeft + list_product_na.clientWidth > list_product_na.scrollWidth - 1) {
                list_product_na.scrollLeft = 0;
            }
        }
    });
});
