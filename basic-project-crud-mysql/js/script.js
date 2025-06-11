const form = document.getElementById("crud-form");
const nameInput = document.getElementById("name");
const valueInput = document.getElementById("value");
const nameError = document.getElementById("name-error");
const valueError = document.getElementById("value-error");

// Function to validate fields and show errors
function validateFields() {
  const nameValue = nameInput.value.trim();
  const valueValue = valueInput.value.trim();

  // Reset errors
  nameError.style.display = "none";
  valueError.style.display = "none";

  let hasError = false;

  // Check Name field
  if (!nameValue) {
    nameError.style.display = "block";
    hasError = true;
  }

  // Check Value field
  if (!valueValue) {
    valueError.style.display = "block";
    hasError = true;
  }

  return !hasError;
}

// Validate on input change to hide errors when user starts typing
nameInput.addEventListener("input", function () {
  if (nameInput.value.trim()) {
    nameError.style.display = "none";
  }
});

valueInput.addEventListener("input", function () {
  if (valueInput.value.trim()) {
    valueError.style.display = "none";
  }
});

// Validate on form submission
form.addEventListener("submit", function (event) {
  if (!validateFields()) {
    event.preventDefault(); // Prevent form submission if validation fails
  }
});
