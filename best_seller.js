const list_product = document.querySelector(".list_product");
const bs_button = document.querySelectorAll(".best_seller_block i");
const firstSlideWidth = list_product.querySelector(".item").offsetWidth;

bs_button.forEach(btn => {
    btn.addEventListener("click", () => {
        if (btn.id === "bs_left") {
            list_product.scrollLeft -= firstSlideWidth;
            //Cuộn về cuối danh sách
            if (list_product.scrollLeft - list_product.clientWidth < 0 ){
                list_product.scrollLeft = list_product.scrollWidth - list_product.clientWidth;
            }
        } else {
            list_product.scrollLeft += firstSlideWidth;
            //Cuộn về đầu trang
            if (list_product.scrollLeft + list_product.clientWidth >= list_product.scrollWidth) {
                list_product.scrollLeft = 0;
            }
        }
    });
});
