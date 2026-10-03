document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.month-checkbox');
    const selectAllCheckbox = document.getElementById('selectAll');
    const paymentChargeInput = document.getElementById('payment-charge');

    const billAmountField = document.getElementById('bill-amount');
    const lateFeeField = document.getElementById('late-fee');
    const totalBillField = document.getElementById('total-bill');
    const grandTotalBillField = document.getElementById('grand-total-bill');
    const grandTotalPaidField = document.getElementById('grand-total-paid');

    const formatNumber = (num) => {
        return new Intl.NumberFormat('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(num);
    };

    const updateTotals = () => {
        let totalPayable = 0;
        let totalFine = 0;

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const row = checkbox.closest('tr');
                totalPayable += parseFloat(row.dataset.payable);
                totalFine += parseFloat(row.dataset.fine);
            }
        });

        const baseBillAmount = totalPayable - totalFine;

        const paymentCharge = parseFloat(paymentChargeInput.value) || 0;

        const grandTotal = totalPayable + paymentCharge;

        billAmountField.value = formatNumber(baseBillAmount);
        lateFeeField.value = formatNumber(totalFine);
        totalBillField.value = formatNumber(grandTotal);
        grandTotalBillField.value = formatNumber(grandTotal);
        grandTotalPaidField.value = formatNumber(grandTotal);
    };

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateTotals);
    });

    selectAllCheckbox.addEventListener('change', () => {
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
        updateTotals();
    });

    paymentChargeInput.addEventListener('input', updateTotals);

    updateTotals();
});

document.addEventListener("DOMContentLoaded", function() {
    const cashSection = document.querySelector(".for-cash");
    const bankSection = document.querySelector(".for-bank");
    const radios = document.querySelectorAll('input[name="payment_method"]');
    const customSpans = document.querySelectorAll('.radio-btn .custom');

    cashSection.style.display = "block";
    bankSection.style.display = "none";

    radios.forEach(radio => {
        radio.addEventListener("change", function() {
            if(this.value === "cash") {
                cashSection.style.display = "block";
                bankSection.style.display = "none";
            } else {
                cashSection.style.display = "none";
                bankSection.style.display = "block";
            }

            customSpans.forEach(span => span.classList.remove("active"));
            this.nextElementSibling.classList.add("active");
        });
    });
});
