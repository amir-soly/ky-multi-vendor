jQuery(document).ready(function ($) {
    // event listener for the search submit button
    $('#mv_search_prodcu_form').submit(function (e) {
        e.preventDefault();

        let searchValue = $('#mv_product_search').val().trim();

        if (searchValue === '') {
            alert('لطفاً نام یک محصول را وارد کنید.');
            return;
        }

        // perform AJAX request
        $.ajax({
            url: stm_wpcfto_ajaxurl,
            type: 'POST',
            data: {
                action: 'search_products',
                search_query: searchValue,
                action_type: 'add_product',
            },
            success: function (response) {
                $('#product_results_container').show();
                $('#results_count').html(`${response.data.products.length} مورد`);

                if (response.success) {
                    displayProducts(response.data.products);
                } else {
                    $('#product_results').html('<p class="text-center text-xl">محصولی یافت نشد!</p>');
                }
            },
            error: function (xhr, status, error) {
                $('#product_results_container').show();

                $('#product_results').html('<p class="text-center text-xl">مشکلی پیش آمده دوباره امتحان کنید.</p>');
            },
        });
    });

    // function to display products in the results section
    function displayProducts(products) {
        let html = '';
        products.forEach(function (product) {
            let addProductBtn;

            if (product.exists == 'true') {
                addProductBtn = `<button class="py-2.5 px-10 text-sm rounded-3xl font-bold bg-primary text-secondary transition-all">فروشنده هستید</button>`;
            } else {
                addProductBtn = `<button class="mv_add_product_too py-2.5 px-10 text-sm rounded-3xl font-bold border border-gray transition-all hover:bg-primary hover:text-secondary hover:border-primary" product-id="${product.product_id}" user-id="${product.seller_id}">شما هم بفروشید</button>`;
            }
            html += `
                <div class="mb-6 pb-6 border-b border-lite-gray last:border-none">
                    <div class="flex-cb mb-6">
                        <div class="btn-flex">
                            <img src="${product.thumbnail}" alt="${product.title}" width="90">
                            <p class="text-xs text-paragraph">${product.title}</p>
                        </div>
                        ${addProductBtn}
                    </div>
                    <div class="flex items-center gap-16">
                        <div>
                            <span class="text-xs text-paragraph">گروه:</span>
                            <span class="text-sm text-secondary">${product.terms}</span>
                        </div>
                        <div>
                            <span class="text-xs text-paragraph">وضعیت جاری:</span>
                            <span class="text-sm text-secondary">${product.exists == 'true' ? 'موجود' : 'غیر موجود'}</span>
                        </div>
                        <div>
                            <span class="text-xs text-paragraph">قیمت:</span>
                            <span class="text-sm text-secondary">${product.price}</span>
                        </div>
                    </div>
                </div>
            `;
        });
        $('#product_results').html(html);
    }




  $(document).on("click", ".mv_add_product_too", function (e) {
    e.preventDefault();

    // دریافت مقادیر data از دکمه
    let productId = $(this).attr("product-id");
    let userId = $(this).attr("user-id");
    let ajaxUrl = $(this).attr("ajax-url");
    let nonce = $(this).attr("wp-nonce");

    // نمایش پاپ آپ و پس زمینه تیره
    $("#popup_overlay").show();
    $("#add_product_popup").show();

    // انتقال داده‌ها به دکمه سابمیت داخل پاپ آپ
    $("#mv_submit_product").data("product-id", productId);
    $("#mv_submit_product").data("user-id", userId);
    $("#mv_submit_product").data("ajax-url", ajaxUrl);
    $("#mv_submit_product").data("wp-nonce", nonce);
  });

  // مخفی کردن پاپ آپ با کلیک روی پس زمینه تیره
  $("#popup_overlay").on("click", function () {
    $("#popup_overlay").hide();
    $("#add_product_popup").hide();
    regularPrice = $("#mv_regular_price").val(" ");
    salePrice = $("#mv_sale_price").val(" ");
    fromSaleDate = $("#mv_from_sale_date").val(" ");
    toSaleDate = $("#mv_to_sale_date").val(" ");
    stock = $("#mv_stock").val(" ");
    minStock = $("#mv_min_stock").val(" ");
    soldIndividually = $("#mv_sold_individually").val(" ");
  });

  $("#mv_submit_product").on("click", function (e) {
    e.preventDefault();

    // دریافت مقادیر data از دکمه سابمیت
    let productId = $(this).data("product-id");
    let userId = $(this).data("user-id");
    let nonce = $(this).data("wp-nonce");

    // دریافت مقادیر فیلدهای فرم
    let regularPrice = $("#mv_regular_price").val();
    let salePrice = $("#mv_sale_price").val();
    let fromSaleDate = $("#mv_from_sale_date").val();
    let toSaleDate = $("#mv_to_sale_date").val();
    let stock = $("#mv_stock").val();
    let minStock = $("#mv_min_stock").val();
    let soldIndividually = $("#mv_sold_individually").val();

    // ارسال درخواست AJAX
    $.ajax({
      type: "POST",
      url: stm_wpcfto_ajaxurl,
      data: {
        action: "mv_add_product",
        nonce: nonce,
        product_id: productId,
        user_id: userId,
        regular_price: regularPrice,
        sale_price: salePrice,
        from_sale_date: fromSaleDate,
        to_sale_date: toSaleDate,
        stock: stock,
        min_stock: minStock,
        sold_individually: soldIndividually,
      },
      success: function (response) {
        let data = response.data;
        if (data.is_sent) {
          $("#popup_overlay").hide();
          $("#add_product_popup").hide();
          // دریافت مقادیر فیلدهای فرم
        } else {
          let Message = data.message;
          $(".alert-box").empty();
          $(".alert-box").slideDown(50);
          $(".alert-box").append('<p class="ErrorMessage">' + Message + "</p>");
        }
      },
      error: function (response) {
        console.log("Error:", response);
      },
    });
  });
});



document.getElementById('get_orders_export').addEventListener('click', function() {
    var sellerId = '114'; // شناسه فروشنده را به درستی مقداردهی کنید

    var formData = new FormData();
    formData.append('action', 'export_orders');
    formData.append('seller_id', sellerId);

    fetch('PATH_TO_YOUR_PHP_SCRIPT', { // مسیر به فایل PHP که در بالا کدش آورده شده
        method: 'POST',
        body: formData
    })
    .then(response => response.blob())
    .then(blob => {
        var url = window.URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = 'orders.xlsx';
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
    })
    .catch(error => console.error('Error:', error));
});
