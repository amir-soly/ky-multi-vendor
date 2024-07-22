jQuery(document).ready(function ($) {
    // debounce function to reduce the number of executions
    function debounce(func, wait) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }
  
    // function to send ajax request
    function sendAjaxRequest() {
        const category_id = $('#pro_list_cat').val();
        const search_query = $('#pro_list_search_box').val();
  
        $('#loader').removeClass('opacity-0 invisible');
        $.ajax({
            url: stm_wpcfto_ajaxurl,
            type: 'POST',
            data: {
                action: 'search_products',
                category_id: category_id,
                search_query: search_query,
                action_type: 'list_products',
            },
            success: function (response) {
                $('#loader').addClass('opacity-0 invisible');

                if (response.success) {
                    displayProductslist(response.data.products);
                } else {
                    $('#products_list').html('<tr><td colspan="5" class="text-center text-xl p-3">محصولی یافت نشد!</td></tr>');
                }
            },
            error: function () {
                $('#loader').addClass('opacity-0 invisible');

                $('#products_list').html('<tr><td colspan="5" class="text-center text-xl p-3">مشکلی پیش آمده دوباره امتحان کنید.</td></tr>');
            },
        });
    }

    // function to display product list
    function displayProductslist(products) {
        let html = '';
        let count = 1;
        products.forEach(function (product) {
            html += `
                <tr class="even:bg-back/30 border-b last:border-b-0">
                    <td class="p-3 text-center font-light" data-label="ردیف">${count}</td>
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

            count++;
        });
        $('#products_list').html(html);
    }
    
    // setup change event on <select>
    $('#pro_list_cat').on('change', debounce(sendAjaxRequest, 500));
  
    // setup input event on <input>
    $('#pro_list_search_box').on('input', debounce(sendAjaxRequest, 500));
});