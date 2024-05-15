function showErrorMessage(message) {
  Swal.fire({
    title: "ຜິດພາດ",
    text: message,
    icon: "error",
    confirmButtonText: "OK",
  });
}

function disableInputAndButton() {
  $("#bid-amount, #place-bid").prop("disabled", true);
}

function showWinningUserPopup() {
  Swal.fire({
    title: "ຂໍສະແດງຄວາມຍິນດີ",
    text: `${winningUserName} ແມ່ນຜູ້ຊະນະປະມູນດ້ວຍລາຄາ ${currentBid} ກີບ`,
    confirmButtonText: "OK",
  });
}

function showWinningUserText() {
  $("#status").text("ປິດປະມູນ").css("color", "red");
  $("#winning-user-text, .auction-end-title").css("display", "block");
}

function handleTimeUp() {
  clearInterval(countdownInterval);
  disableInputAndButton();
  showWinningUserText();
  $("#winning-user-text").on("click", showWinningUserPopup);
}

$(document).ready(function () {
    const bidAmountInput = $("#bid-amount");
    const currentBidDisplay = $("#current-bid");
    const minimumBidDisplay = $("#minimum-bid");
    const bidList = $("#bid-list");
    const placeBidButton = $("#place-bid");
    const countdownDisplay = $("#countdown");
    const winningUserText = $("#winning-user-text");
    const auctionEndTitle = $(".auction-end-title");
    const popup = $("#popup");
    const largeImage = $("#largeImage");
    const smallImages = $(".img-small");
    const finalBidDisplay = $("#final-bid");
    const AuctionStatus = $("#status");
    const market_img = $(".market-img");

    // Set initial values from HTML elements
    currentBidDisplay.text($("#current-bid").text());
    minimumBidDisplay.text($("#minimum-bid").text());
  var countdownText = $("#countdown").text();
console.log($("#current-bid").val());
  // Extract the number of days from the countdown text
  var days = parseInt(countdownText);

  // Convert days to minutes (assuming 1 day = 24 hours = 1440 minutes)
  var countdownMinutes = days * 1440;

  // Start the countdown after setting up the countdown minutes
  startCountdown();
  function updateCountdown() {
    let days = Math.floor(countdownMinutes / (60 * 24));
    let hours = Math.floor((countdownMinutes % (60 * 24)) / 60);
    let minutes = countdownMinutes % 60;
    let seconds = countdownSeconds;

    if (days > 0) {
      countdownDisplay.text(`${days} ວັນ`);
    //   console.log(countdownDisplay.text());
    } else {
      countdownDisplay.text(`${hours}:${minutes
        .toString()
        .padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`);
    }
  }
  var countdownSeconds = 0; // Initialize countdownSeconds here
  function startCountdown() {
    countdownInterval = setInterval(function () {
      if (countdownMinutes === 0 && countdownSeconds === 0) {
        handleTimeUp();
      } else if (countdownSeconds === 0) {
        countdownMinutes--;
        countdownSeconds = 59;
      } else {
        countdownSeconds--;
      }
      updateCountdown();
    }, 1000);
  }
  console.log(currentBidDisplay.val());

  $("#bid-form").on("submit", function (event) {
    event.preventDefault();
    const inputBidAmount = parseFloat($("#bid-amount").val());
    console.log(inputBidAmount);
      const bidAmount = inputBidAmount;
      console.log(bidAmount);
      if (bidAmount > currentBidDisplay.val()) {
        addBidToHistoryTable(bidAmount, "moss tit hee");
        currentBid = bidAmount;
        currentBidDisplay.text(currentBid);
      } else {
        showErrorMessage("ລາຄາທີ່ສະເໜີຕ້ອງສູງກວ່າລາຄາປັດຈຸບັນ");
      }
  });

  let number = 1;

  function getCurrentDateTime() {
    const now = new Date();
    const year = now.getFullYear();
    const month = now.getMonth() + 1;
    const day = now.getDate();
    const hours = now.getHours();
    const minutes = now.getMinutes();
    const amOrPm = hours >= 12 ? "PM" : "AM";
    const formattedHours = hours % 12 || 12;
    const formattedMinutes = minutes.toString().padStart(2, "0");
    return `${year}-${month}-${day} ${formattedHours}:${formattedMinutes} ${amOrPm}`;
  }

  function addBidToHistoryTable(bidAmount, bidderName) {
    const newRow = `
            <tr>
                <td>${number}</td>
                <td>${bidderName}</td>
                <td>$${bidAmount}</td>
                <td>${getCurrentDateTime()}</td>
            </tr>
        `;
    $("#bid-history-table").append(newRow);
    number++;
    winningUserName = bidderName;
    $("#bid-amount").val("");
  }
});
