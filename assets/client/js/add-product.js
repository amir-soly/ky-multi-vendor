jQuery(document).ready(function ($) {
  jQuery(document).ready(function ($) {
    $("#mv_search_submit").click(function (e) {
      e.preventDefault(); // جلوگیری از ارسال فرم به صورت پیش‌فرض

      let searchValue = $("#mv_product_search").val().trim();
      let ajaxUrl = $(this).attr("ajax-url");

      if (searchValue === "") {
        alert("لطفاً یک محصول را وارد کنید.");
        return;
      }

      $.ajax({
        url: ajaxUrl, // آدرس URL فایل PHP که درخواست را پردازش می‌کند
        type: "POST",
        data: {
          action: "search_products", // نام اکشن برای وردپرس
          search_query: searchValue,
          action_type: "add_product",
        },
        success: function (response) {
          if (response.data.is_sent) {
            displayProducts(response.data.products);
            console.log(response.data.products);
          } else {
            $("#product-results").html("<p>No products found.</p>");
          }
        },
        error: function (xhr, status, error) {
          console.error(error);
          $("#product-results").html(
            "<p>Error occurred while fetching products.</p>"
          );
        },
      });
    });

    function displayProducts(products) {
      var html = "";
      products.forEach(function (product) {
        html += `
                <div class="mb-6 pb-6 border-b border-lite-gray last:border-none">
                    <div class="flex-cb mb-6">
                        <div class="btn-flex">
                            <img src="${product.thumbnail}" alt="${
          product.title
        }" width="90">
                            <p class="text-xs text-paragraph">${
                              product.title
                            }</p>
                        </div>
                        <button class="py-2.5 px-10 text-sm rounded-3xl font-bold border border-gray transition-all hover:bg-primary hover:text-secondary hover:border-primary mv_add_product_too exists_${
                          product.exists
                        }" product-id="${product.product_id}" ${
          product.exists == "true" ? "disabled" : ""
        } user-id="${product.seller_id}" ajax-url="" wp-nonce="">${
          product.exists == "true" ? "این کالا را می فروشید" : "شما هم بفروشید"
        }</button>
                    </div>
                    <div class="flex items-center gap-16">
                        <div>
                            <span class="text-xs text-paragraph">گروه:</span>
                            <span class="text-sm text-secondary">${
                              product.terms
                            }</span>
                        </div>
                        <div>
                            <span class="text-xs text-paragraph">وضعیت جاری:</span>
                            <span class="text-sm text-secondary">${
                              product.exists == "true" ? "موجود" : "غیر موجود"
                            }</span>
                        </div>
                        <div>
                            <span class="text-xs text-paragraph">قیمت:</span>
                            <span class="text-sm text-secondary">${
                              product.price
                            }</span>
                        </div>
                    </div>
                </div>
            `;
      });
      $("#product-results").html(html);
    }
  });

  $(".mv_add_product_too").on("click", function (e) {
    e.preventDefault();

    // دریافت مقادیر data از دکمه
    var productId = $(this).attr("product-id");
    var userId = $(this).attr("user-id");
    var ajaxUrl = $(this).attr("ajax-url");
    var nonce = $(this).attr("wp-nonce");

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
    var productId = $(this).data("product-id");
    var userId = $(this).data("user-id");
    var ajaxUrl = $(this).data("ajax-url");
    var nonce = $(this).data("wp-nonce");

    // دریافت مقادیر فیلدهای فرم
    var regularPrice = $("#mv_regular_price").val();
    var salePrice = $("#mv_sale_price").val();
    var fromSaleDate = $("#mv_from_sale_date").val();
    var toSaleDate = $("#mv_to_sale_date").val();
    var stock = $("#mv_stock").val();
    var minStock = $("#mv_min_stock").val();
    var soldIndividually = $("#mv_sold_individually").val();

    // ارسال درخواست AJAX
    $.ajax({
      type: "POST",
      url: ajaxUrl,
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
        var data = response.data;
        if (data.is_sent) {
          $("#popup_overlay").hide();
          $("#add_product_popup").hide();
          // دریافت مقادیر فیلدهای فرم
        } else {
          var Message = data.message;
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

jQuery(document).ready(function ($) {
  // تابع debounce برای کاهش تعداد بارهای اجرا
  function debounce(func, wait) {
    let timeout;
    return function (...args) {
      clearTimeout(timeout);
      timeout = setTimeout(() => func.apply(this, args), wait);
    };
  }

  // تابع برای ارسال درخواست AJAX
  function sendAjaxRequest() {
    const category_id = $("#pro_list_cat").val();
    const search_query = $("#pro_list_search_box").val();

    $.ajax({
      url: "http://localhost/persia-theme/wp-admin/admin-ajax.php", // URL برای ارسال درخواست AJAX، معمولاً 'admin-ajax.php' در وردپرس
      type: "POST",
      data: {
        action: "search_products", // نام اکشن برای شناسایی در وردپرس
        category_id: category_id,
        search_query: search_query,
        action_type: "list_products",
      },
      success: function (response) {
        if (response.data.is_sent) {
          var html = "";
          response.data.products.forEach(function (product) {
            html += `
                  <tr class="even:bg-back/30 border-b last:border-b-0">
                              <td class="p-3 text-center font-light" data-label="ردیف"><?= $counter++;?></td>
                              <td class="p-3" data-label="عنوان">
                                  <div class="flex-cb gap-4">
                                      <img src="${product.thumbnail}" alt="" width="45" class="rounded-md">
                                      <p>${product.title}</p>
                                  </div>
                              </td>
                              <td class="p-3 text-center" data-label="دسته بندی">${product.terms}</td>
                              <td class="p-3 text-center" data-label="وضعيت"><span class="w-full block rounded-full py-2 text-center text-green-700 bg-green-700/25">${product.status}</span></td>
                              <td class="p-3"><a href="?action=edit&seller=${product.seller_id}&product=${product.product_id}" class="bg-secondary w-full block rounded-full text-center text-white py-2">ویرایش</a></td>
                          </tr>
              `;
          });
          $("#product_box").html(html);
        } else {
          $("#product_box").html("<p>No products found.</p>");
        }
      },
      error: function () {
        $("#product_box").html("An error occurred.");
      },
    });
  }
  function displayProductslist(products) {
    var html = "";
    products.forEach(function (product) {
      html += `
            <tr class="even:bg-back/30 border-b last:border-b-0">
                        <td class="p-3 text-center font-light" data-label="ردیف"><?= $counter++;?></td>
                        <td class="p-3" data-label="عنوان">
                            <div class="flex-cb gap-4">
                                <img src="${product.thumbnail}" alt="" width="45" class="rounded-md">
                                <p>${product.title}</p>
                            </div>
                        </td>
                        <td class="p-3 text-center" data-label="دسته بندی">${product.terms}</td>
                        <td class="p-3 text-center" data-label="وضعيت"><span class="w-full block rounded-full py-2 text-center text-green-700 bg-green-700/25">${product.status}</span></td>
                        <td class="p-3"><a href="?action=edit&seller=${product.seller_id}&product=${product.product_id}" class="bg-secondary w-full block rounded-full text-center text-white py-2">ویرایش</a></td>
                    </tr>
        `;
    });
    $("#product_box").html(html);
  }
  // راه‌اندازی رویداد تغییر در <select>
  $("#pro_list_cat").on("change", debounce(sendAjaxRequest, 500));

  // راه‌اندازی رویداد تایپ در <input>
  $("#pro_list_search_box").on("input", debounce(sendAjaxRequest, 500));
});
