// Function to add a new discount item.
document.getElementById('add-new-item-button').addEventListener('click', function () {
    // Clear the form fields for adding a new item.
    document.getElementById('rule_name').value = '';
    document.getElementById('discount_label').value = '';
    document.getElementById('discount_priority').value = '';
    document.getElementById('discount_type').value = '';
    document.getElementById('discount_value').value = '';
    document.getElementById('dynamic-fields-container').style.display = 'block';
});

// Function to save the settings.
document.getElementById('save-button').addEventListener('click', function () {
    
    const ruleName = document.getElementById('rule_name').value;
    const discountLabel = document.getElementById('discount_label').value;
    const discountPriority = document.getElementById('discount_priority').value;
    const discountType = document.getElementById('discount_type').value;
    const discountValue = document.getElementById('discount_value').value;
    const editIndex = document.getElementById('edit_index') ? document.getElementById('edit_index').value : "null";

    if (!ruleName || !discountLabel || !discountPriority || !discountType || !discountValue) {
        alert('Please fill in all fields.');
        return;
    } else {
        fetch(siteConfig.ajaxUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'save_discount_item_details',
                index: editIndex,
                rule_name: ruleName,
                discount_label: discountLabel,
                discount_priority: discountPriority,
                discount_type: discountType,
                discount_value: discountValue,
            }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response is not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }
});

document.querySelectorAll('.discount-item-row').forEach(function (row) {
    row.addEventListener('click', function () {
        const index = this.getAttribute('data-index');


        // Start ---- Commented out AJAX call

        // Make an AJAX call to fetch the details of the selected item
        // fetch(siteConfig.ajaxUrl + `?action=get_discount_item_details&index=${index}`)
        //     .then(response => {
        //         if (!response.ok) {
        //             throw new Error('Network response is not ok');
        //         }
        //         return response.json();
        //     })
        //     .then(data => {
        //         // Populate the form fields with the fetched item's details
        //         document.getElementById('rule_name').value = data.rule_name;
        //         document.getElementById('discount_label').value = data.discount_label;
        //         document.getElementById('discount_priority').value = data.discount_priority;
        //         document.getElementById('discount_type').value = data.discount_type;
        //         document.getElementById('discount_value').value = data.discount_value;

        //         // Show the form for editing
        //         document.getElementById('dynamic-fields-container').style.display = 'block';

        //         console.log(data.rule_name, data.discount_label, data.discount_priority, data.discount_type, data.discount_value);

        //         // Optionally, track the index of the item being edited
        //         let editIndexField = document.getElementById('edit_index');
        //         if (!editIndexField) {
        //             editIndexField = document.createElement('input');
        //             editIndexField.type = 'hidden';
        //             editIndexField.id = 'edit_index';
        //             editIndexField.name = 'edit_index';
        //             document.querySelector('form').appendChild(editIndexField);
        //         }
        //         editIndexField.value = index;
        //     })
        //     .catch(error => {
        //         console.error('There was a problem with the fetch operation:', error);
        //     });

        // End ---- Commented out AJAX call



        // Populate the form fields with the selected item's details
        const ruleName = this.querySelector('.discount-rule-name-cell').textContent.trim();
        const discountLabel = this.querySelector('.discount-label-cell').textContent.trim();
        const discountPriority = this.querySelector('.discount-priority-cell').textContent.trim();
        const discountType = this.querySelector('.discount-type-cell').textContent.trim();
        const discountValue = this.querySelector('.discount-value-cell').textContent.trim();

        document.getElementById('rule_name').value = ruleName;
        document.getElementById('discount_label').value = discountLabel;
        document.getElementById('discount_priority').value = discountPriority;
        document.getElementById('discount_type').value = discountType;
        document.getElementById('discount_value').value = discountValue;

        // Show the form for editing
        document.getElementById('dynamic-fields-container').style.display = 'block';

        // Optionally, you can add a hidden field to track the index of the item being edited
        let editIndexField = document.getElementById('edit_index');
        if (!editIndexField) {
            editIndexField = document.createElement('input');
            editIndexField.type = 'hidden';
            editIndexField.id = 'edit_index';
            editIndexField.name = 'edit_index';
            document.querySelector('form').appendChild(editIndexField);
        }
        editIndexField.value = index;
    });
});