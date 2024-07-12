jQuery(document).ready(function ($) {
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
    regularPrice = $("#mv_regular_price").val(' ');
    salePrice = $("#mv_sale_price").val(' ');
    fromSaleDate = $("#mv_from_sale_date").val(' ');
    toSaleDate = $("#mv_to_sale_date").val(' ');
    stock = $("#mv_stock").val(' ');
    minStock = $("#mv_min_stock").val(' ');
    soldIndividually = $("#mv_sold_individually").val(' ');
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
