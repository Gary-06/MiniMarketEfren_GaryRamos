document.getElementById('productForm').addEventListener('submit', function(event) {
  let valid = true;
  const productName = document.getElementById('productName');
  const productPrice = document.getElementById('productPrice');
  const productQuantity = document.getElementById('productQuantity');

  const productNameError = document.getElementById('productNameError');
  const productPriceError = document.getElementById('productPriceError');
  const productQuantityError = document.getElementById('productQuantityError');

  if (productName.value.trim() === '') {
      productNameError.textContent = 'El nombre del producto es obligatorio.';
      valid = false;
  } else {
      productNameError.textContent = '';
  }

  if (!/^\d+(\.\d{1,2})?$/.test(productPrice.value)) {
      productPriceError.textContent = 'El precio debe ser un número válido.';
      valid = false;
  } else {
      productPriceError.textContent = '';
  }

  if (!/^\d+$/.test(productQuantity.value)) {
      productQuantityError.textContent = 'La cantidad debe ser un número entero.';
      valid = false;
  } else {
      productQuantityError.textContent = '';
  }

  if (!valid) {
      event.preventDefault();
  }
});