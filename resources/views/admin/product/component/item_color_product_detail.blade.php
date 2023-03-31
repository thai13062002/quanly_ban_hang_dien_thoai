 @foreach ($listColor as $item)
     <tr>
         {{-- <td class="text-center text-muted"><img
                 src="{{ asset('storage/ProductDetailColor' . '/' . $item['img'][0]['path']) }}" alt=""
                 style="width: 50px;height: 50px;">
         </td> --}}
         <td class="text-center text-muted">{{ $item['color']['name'] }}</td>
         <td class="text-center"><input type="number" min="1" value={{ $item['quantity'] }} class="quantity-product-color"></td>
         <td class="text-center">
             <button data-id="{{ $item['color_id'] }}"
                 class="btn btn-hover-shine btn-outline-danger border-0 btn-sm delete-color" type="submit"
                 data-toggle="tooltip" title="Delete" data-placement="bottom">
                 <span class="btn-icon-wrapper opacity-8">
                     <i class="bi bi-trash"></i>
                 </span>
             </button>
             <button title="save" data-placement="bottom" data-id="{{ $item['color_id'] }}" disabled
                 class="btn btn-hover-shine btn-outline-success border-0 btn-sm update-color">
                 <span class="btn-icon-wrapper opacity-8">
                     <i class="bi bi-save-fill"></i>
                 </span>
             </button>
         </td>
     </tr>
 @endforeach
