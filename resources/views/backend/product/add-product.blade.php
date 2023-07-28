@extends('admin.app-layout')
@section('title')
    Add Product
@endsection
@section('subtitle')
    Add new product
@endsection
@section('content')

<style>
  #preview_img, #mainThumb {
    margin: 7px 2px;
    background-color: #f0f0f0; /* Fondo gris */
    padding: 10px 5px; /* Puedes agregar un padding para espaciar las imágenes si lo deseas */
  }

  /* Estilo para las imágenes dentro del contenedor */
  #preview_img img {
    display: block; /* Para que las imágenes se muestren como bloques y no en línea */
    margin-bottom: 7px; /* Agrega un margen inferior entre las imágenes */
  }
</style>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>


<div class="card">
    <div class="card-body p-4">
        <h5 class="card-title">Add New Product</h5>
        <hr/>

        <form id="myForm" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

         <div class="form-body mt-4">
          <div class="row">
             <div class="col-lg-8">
             <div class="border border-3 p-4 rounded">

                <div class="form-group mb-3">
                  <label for="productname" class="form-label">Product Name</label>
                  <input type="text" class="form-control" name="product_name" id="productname" placeholder="Enter product name">
                </div>
                <!-- name -->

                <div class="mb-3">
                  <label for="product-tag" class="form-label">Product Tags</label>
                  <input type="text" id="product-tag" name="product_tags" class="form-control visually-hidden" data-role="tagsinput" value="NEW,TOP">
                </div>
                <!-- tags -->


                <!-- MODAL COLOR -->

                <div class="col mb-3">
                  <input type="hidden" name="colors_data" id="selectedColorsDataInput">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleDarkModal">Select color</button>
                  
                  <!-- Modal -->
                  <div class="modal fade " id="exampleDarkModal" tabindex="-1" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                      <div class="modal-content bg-dark">
                        <div class="modal-header">
                          <h5 class="modal-title text-white">Select Colors</h5>
                          <button type="button" class="btn btn-danger btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-white">
                          <div class="mb-3">
                            <label for="product-color" class="form-label">Product Color</label>
                             <select name="product-color" class="form-select" id="product-color">
                              <option selected disabled>-- Select --</option>
                                 @foreach ($colors as $color)
                              <option value="{{$color->id}}">{{$color->name}}</option>
                             @endforeach
                            </select>
                          </div>
                          <!-- color -->

                          <div class="card-body">
                            <table class="table mb-0 table-dark table-striped" id="selectedColorsTable">
                              <thead>
                                <tr>
                                  <th scope="col">#ID</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Cantidad</th>
                                  <th scope="col">Delete</th>
                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success" id="saveChangesBtn">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="form-group mb-3">
                  <label for="inputProductDescriptionShort" class="form-label">Short Description</label>
                  <textarea class="form-control" name="short_desc" id="inputProductDescriptionShort" rows="2"></textarea>
                </div>
                <!-- short desc -->

                <div class="mb-3">
                  <label for="inputProductDescriptionLong" class="form-label">Long Description</label>
                  <textarea id="mytextarea" name="long_desc"></textarea>
                </div>
                <!-- long desc -->

                <div class="form-group mb-3">
                  <label for="inputimageThambnail" class="form-label">Main Thambnail</label>
                  <input name="product_thambnail" class="form-control" onchange="mainThamUrl(this)" type="file" id="inputimageThambnail">
                  <img src="" id="mainThumb" alt="">
                </div>
                <!-- img Thambnail -->

                <div class="form-group mb-3">
                  <label for="multiImg" class="form-label">Multi Image</label>
                  <input class="form-control" name="multi_img[]" type="file" id="multiImg" multiple="">

                  <div class="row" id="preview_img">

                  </div>
                </div>
                <!-- img Multi -->

              </div>
             </div>
             <div class="col-lg-4">
              <div class="border border-3 p-4 rounded">
                <div class="row g-3">
                    <div class="form-group col-md-6">
                      <label for="inputPrice" class="form-label">Price</label>
                      <input type="number" class="form-control" id="inputPrice" name="selling_price" step="0.01" placeholder="00.00" required>
                    </div>
                    <!-- Price -->
                    <div class="form-group col-md-6">
                      <label for="inputDiscountprice" class="form-label">Discount Price</label>
                      <input type="number" class="form-control" name="discount_price" id="inputDiscountprice" step="0.01" placeholder="00.00">
                    </div>
                    <!-- Discount -->
                    <div class="form-group col-md-6">
                      <label for="inputcodeProduct" class="form-label">Product Code</label>
                      <input type="text" name="product_code" class="form-control" id="inputcodeProduct" step="1" placeholder="0">
                    </div>
                    <!-- Code -->
                    <div class="form-group col-md-6">
                      <label for="inputQuantity" class="form-label">Quantity</label>
                      <input type="number" class="form-control" id="inputQuantity" name="quantity" step="1" placeholder="0" required>
                    </div>
                    <!-- QTY -->
                  
                    <div class="form-group col-12">
                      <label for="inputProductBrand" class="form-label">Product Brand</label>
                      <select name="brand_id" class="form-select" id="inputProductBrand">
                          <option selected disabled>-- Select --</option>
                          @foreach ($brands as $brand)
                          <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                          @endforeach
                        </select>
                    </div>
                    <!-- Brand -->
                  
                    <div class="form-group col-12">
                      <label for="inputProductCategory" class="form-label">Product Category</label>
                      <select name="category_id" class="form-select" id="inputProductCategory">
                          <option selected disabled>-- Select --</option>
                          @foreach ($categories as $category)
                          <option value="{{$category->id}}">{{$category->category_name}}</option>
                          @endforeach
                          
                        </select>
                    </div>
                    <!-- Category -->
                  
                    <div class="form-group col-12">
                      <label for="inputCollection" class="form-label">Product SubCategory</label>
                      <select name="subcategory_id" class="form-select" id="inputCollection">
                        <option></option>

                        </select>
                    </div>
                    <!-- SubCategory -->
                  
                    <div class="col-12">
                      <label for="inputProductVendor" class="form-label">Select Vendor</label>
                      <select name="vendor_id" class="form-select" id="inputProductVendor">
                          <option selected disabled>-- Select --</option>
                          @foreach ($activeVendor as $vendor)
                          <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                          @endforeach
                        </select>
                    </div>
                    <!-- Vendor -->

                    <div class="col-12">
                      <div class="row g-3">

                        <div class="col-md-6"> 
                          <div class="form-check">
                            <input class="form-check-input" name="hot_deals" type="checkbox" value="1" id="Deals">
                            <label class="form-check-label" for="Deals">Hot Deals</label>
                          </div>
                        </div>

                        <div class="col-md-6"> 
                          <div class="form-check">
                            <input class="form-check-input" name="featured" type="checkbox" value="1" id="Featured">
                            <label class="form-check-label" for="Featured">Featured</label>
                          </div>
                        </div>

                        <div class="col-md-6"> 
                          <div class="form-check">
                            <input class="form-check-input" name="special_offer" type="checkbox" value="1" id="special_offer">
                            <label class="form-check-label" for="special_offer">Special Offer</label>
                          </div>
                        </div>

                        <div class="col-md-6"> 
                          <div class="form-check">
                            <input class="form-check-input" name="special_deals" type="checkbox" value="1" id="special_deals">
                            <label class="form-check-label" for="special_deals">Special Deals</label>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!-- Price -->

                    

                    <div class="col-12">
                        <div class="d-grid">
                           <input type="submit" class="btn btn-primary" value="Add Product">
                        </div>
                    </div>

                </div> 
            </div>
            </div>
         </div><!--end row-->
        </div>

      </form>
    </div>
</div>

<script type="text/javascript">
   
   function mainThamUrl(input){
    if(input.files && input.files[0]){
      let reader = new FileReader();
      reader.onload = function(e){
        $('#mainThumb').attr('src', e.target.result).width(80).height(80);

      };
      reader.readAsDataURL(input.files[0]);
    }
   }

</script>


<script> 
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png|webp|avif)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
</script>


<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('select[name="category_id"]').addEventListener('change', function() {
      var category_id = this.value;
      if (category_id) {
        fetch("{{ url('/subcategory/ajax') }}/" + category_id)
          .then(response => response.json())
          .then(data => {
            var subcategorySelect = document.querySelector('select[name="subcategory_id"]');
            subcategorySelect.innerHTML = '';
            data.forEach(function(value) {
              subcategorySelect.insertAdjacentHTML('beforeend', '<option value="' + value.id + '">' + value.subcategory_name + '</option>');
            });
          })
          .catch(error => {
            console.error('Error:', error);
          });
      } else {
        alert('danger');
      }
    });
  });
</script>

<!-- COLOR -->
<script>
  $(document).ready(function() {
    var selectedColors = []; // Array para almacenar los colores seleccionados con sus cantidades

    function eliminarFila(colorId) {
    // Convertir el ID del color a un número entero
    colorId = parseInt(colorId);

    // Verificar si el ID del color coincide con el ID almacenado en el array
    console.log('Array de colores seleccionados:', selectedColors);

    // Encontrar el índice del color en el array selectedColors
    var colorIndex = selectedColors.findIndex(color => color.id === colorId);

    // Si se encontró el color en el array, eliminarlo
    if (colorIndex !== -1) {
        selectedColors.splice(colorIndex, 1);
    }

    // Eliminar la fila visualmente de la tabla
    $(`#selectedColorsTable tbody tr[data-color-id="${colorId}"]`).remove();

    console.log('Array de colores seleccionados después de eliminar:', selectedColors);
    } 




    // Función para agregar una fila a la tabla de colores seleccionados
    function agregarFila(colorId, colorName, cantidad) {

      colorId = parseInt(colorId);

      var newRow = `
        <tr data-color-id="${colorId}">
          <th scope="row">${colorId}</th>
          <td>${colorName}</td>
          <td><input type="number" class="cantidadInput" value="${cantidad}" min="1"></td>
          <td><button type="button" class="btn btn-danger eliminarColorBtn" data-color-id="${colorId}">Eliminar</button></td>
        </tr>`;
      $('#selectedColorsTable tbody').append(newRow);

      // Agregar el color al array selectedColors
      selectedColors.push({
        id: colorId,
        name: colorName,
        cantidad: cantidad
      });

      // Escuchar por cambios en la cantidad y actualizar el array
      $(`#selectedColorsTable tbody tr[data-color-id="${colorId}"] .cantidadInput`).on('change', function() {
        var newCantidad = parseInt($(this).val());
        if (!isNaN(newCantidad) && newCantidad > 0) {
          var colorIndex = selectedColors.findIndex(color => color.id === colorId);
          if (colorIndex !== -1) {
            selectedColors[colorIndex].cantidad = newCantidad;
          }
        }
      });
    }

    // Evento para agregar una fila cuando el usuario selecciona un color
    $('#product-color').on('change', function() {
      var colorId = $(this).val();
      var colorName = $("#product-color option:selected").text();
      if (colorId) {
        agregarFila(colorId, colorName, 1);
      }
    });

    // Evento para eliminar una fila cuando el usuario hace clic en el botón "Eliminar"
    $('#selectedColorsTable').on('click', '.eliminarColorBtn', function() {
      var colorId = $(this).data('color-id');
      eliminarFila(colorId);
    });

    // Evento para guardar los cambios
    $('#saveChangesBtn').on('click', function() {
      // Obtener las cantidades de cada color seleccionado y actualizar el array
      $('#selectedColorsTable tbody tr').each(function() {
        var colorId = $(this).find('th').text();
        var cantidad = $(this).find('.cantidadInput').val();
        var colorIndex = selectedColors.findIndex(color => color.id === parseInt(colorId));
        if (colorIndex !== -1) {
          // Convertir la cantidad a número entero
          cantidad = parseInt(cantidad);
          // Verificar si la cantidad es un número válido
          if (!isNaN(cantidad) && cantidad > 0) {
            selectedColors[colorIndex].cantidad = cantidad;
          }
        }
      });

      console.log(selectedColors);

      // Actualizar el campo oculto con los datos del array selectedColors en formato JSON
      $('#selectedColorsDataInput').val(JSON.stringify(selectedColors));

    });
  });
</script>





<script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
          rules: {
              product_name: {
                  required : true,
              }, 
               short_descp: {
                  required : true,
              }, 
               product_thambnail: {
                  required : true,
              }, 
               multi_img: {
                  required : true,
              }, 
               selling_price: {
                  required : true,
              },                   
               product_code: {
                  required : true,
              }, 
               product_qty: {
                  required : true,
              }, 
               brand_id: {
                  required : true,
              }, 
               category_id: {
                  required : true,
              }, 
               subcategory_id: {
                  required : true,
              }, 
          },
          messages :{
              product_name: {
                  required : 'Please Enter Product Name',
              },
              short_descp: {
                  required : 'Please Enter Short Description',
              },
              product_thambnail: {
                  required : 'Please Select Product Thambnail Image',
              },
              multi_img: {
                  required : 'Please Select Product Multi Image',
              },
              selling_price: {
                  required : 'Please Enter Selling Price',
              }, 
              product_code: {
                  required : 'Please Enter Product Code',
              },
               product_qty: {
                  required : 'Please Enter Product Quantity',
              },
          },
          errorElement : 'span', 
          errorPlacement: function (error,element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
          },
          highlight : function(element, errorClass, validClass){
              $(element).addClass('is-invalid');
          },
          unhighlight : function(element, errorClass, validClass){
              $(element).removeClass('is-invalid');
          },
      });
  });
  
</script>



@endsection