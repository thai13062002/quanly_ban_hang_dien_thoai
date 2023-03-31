 {{-- <tr id="item-{{ $productDetail['id'] }}">
     <td class="text-center text-muted">{{ $productDetail['capacity'] }}</td>
     <td class="text-center">{{ $productDetail['price_import'] }}</td>
     <td class="text-center">{{ $productDetail['price_sell'] }}</td>
     <td class="text-center" class="quantity-{{ $productDetail['id'] }}">
         {{ $quantity }}
     </td>
     <td class="text-center">
         <a class="btn btn-hover-shine btn-outline-primary border-0 btn-sm update-detail" data-toggle="modal"
             data-target="#modalEditDetailProduct" data-id="{{ $productDetail['id'] }}">
             <span class="btn-icon-wrapper opacity-8">
                 <i class="bi bi-tools"></i>
             </span>
         </a>
         <a data-id={{ $productDetail['id'] }} data-toggle="modal" data-target="#modalEditDetailColor"
             data-original-title="Sửa" class="btn btn-outline-warning border-0 btn-sm list-color">
             <span class="btn-icon-wrapper opacity-8">
                 <i class="bi bi-pencil-square"></i>
             </span>
         </a>
         <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm remove" type="button"
             data-toggle="tooltip" title="Delete" data-placement="bottom" data-id="{{ $productDetail['id'] }}">
             <span class="btn-icon-wrapper opacity-8">
                 <i class="bi bi-trash"></i>
             </span>
         </button>
         <a data-id={{ $productDetail['id'] }} data-toggle="modal" data-target="#modalColor" data-toggle="tooltip"
             data-original-title="Thêm" class="btn btn-outline-info border-0 btn-sm add-color">
             <span class="btn-icon-wrapper opacity-8">
                 <i class="bi bi-plus"></i>
             </span>
         </a>
     </td>
 </tr> --}}
 <tr id="item-{{ $productDetail['id'] }}">
     <td class="text-center text-muted item-capacity">{{ $productDetail['capacity'] }}
     </td>
     <td class="text-center item-price_import">{{ $productDetail['price_import'] }}</td>
     <td class="text-center item-price_sell">{{ $productDetail['price_sell'] }}</td>
     <td class="text-center {{ 'quantity-' . $productDetail['id'] }}">
         @if (!empty($productDetail['product_detail_color']))
             {{ array_sum(array_column($productDetail['product_detail_color'], 'quantity')) }}
         @else
             0
         @endif
     </td>
     <td class="text-center">
         <a class="btn btn-hover-shine btn-outline-primary border-0 btn-sm update-detail" data-toggle="modal"
             data-target="#modalEditDetailProduct" data-id="{{ $productDetail['id'] }}">
             <span class="btn-icon-wrapper opacity-8">
                 <i class="bi bi-tools"></i>
             </span>
         </a>
         <a data-id={{ $productDetail['id'] }} data-toggle="modal" data-target="#modalEditDetailColor"
             data-original-title="Sửa" class="btn btn-outline-warning border-0 btn-sm list-color">
             <span class="btn-icon-wrapper opacity-8">
                 <i class="bi bi-pencil-square"></i>
             </span>
         </a>
         <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm remove" type="button"
             data-toggle="tooltip" title="Delete" data-placement="bottom" data-id="{{ $productDetail['id'] }}">
             <span class="btn-icon-wrapper opacity-8">
                 <i class="bi bi-trash"></i>
             </span>
         </button>
         <a data-id={{ $productDetail['id'] }} data-toggle="modal" data-target="#modalColor" data-toggle="tooltip"
             data-original-title="Thêm" class="btn btn-outline-info border-0 btn-sm add-color">
             <span class="btn-icon-wrapper opacity-8">
                 <i class="bi bi-plus"></i>
                 Thêm màu
             </span>
         </a>
     </td>
 </tr>
