<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PayPal JS SDK Demo</title>
</head>

<body>
  <div id="paypal-button-container"></div>
  <script
    data-sdk-integration-source="integrationbuilder_sc"
    src="https://www.paypal.com/sdk/js?client-id=AW6IItKqFlY_wY4a0L_9wJ97PFoDY734dhsRZ45Iz572a4sOtDPyWjZ28ATRpy5fWjTPtg-xx8yqoCQc&components=buttons&enable-funding=venmo,paylater"></script>
    <script>
    const FUNDING_SOURCES = [
      paypal.FUNDING.PAYPAL,
      paypal.FUNDING.CARD
    ];
    
    FUNDING_SOURCES.forEach(fundingSource => {
      paypal.Buttons({
        fundingSource,
        style: {
          layout: 'vertical',
          shape: 'rect',
          color: (fundingSource == paypal.FUNDING.PAYLATER) ? 'gold' : '',
        },
        createOrder: async (data, actions) => {
          try {
            const response = await fetch("http://localhost:9597/orders", {
              method: "POST"
            });

            const details = await response.json();
            return details.id;
          } catch (error) {
            console.error(error);
            // Handle the error or display an appropriate error message to the user
          }
        },

        onApprove: async (data, actions) => {
          try {
            const response = await fetch(`http://localhost:9597/orders/${data.orderID}/capture`, {
              method: "POST"
            });

            const details = await response.json();

            const errorDetail = Array.isArray(details.details) && details.details[0];

            if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
              return actions.restart();
            }

            if (errorDetail) {
              let msg = 'Sorry, your transaction could not be processed.';
              msg += errorDetail.description ? ' ' + errorDetail.description : '';
              msg += details.debug_id ? ' (' + details.debug_id + ')' : '';
              alert(msg);
            }

            console.log('Capture result', details, JSON.stringify(details, null, 2));
            const transaction = details.purchase_units[0].payments.captures[0];
            alert('Transaction ' + transaction.status + ': ' + transaction.id + 'See console for all available details');
          } catch (error) {
            console.error(error);
            // Handle the error or display an appropriate error message to the user
          }
        },
      }).render("#paypal-button-container");
    });
  </script>
</body>

</html>