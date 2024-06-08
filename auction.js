function disableInputAndButton() {
    $("#bid-amount, #place-bid").prop("disabled", true);
}

function showWinningUserPopup() {
    const winningUserName = auctionData.winning_username;
    const currentBid = auctionData.winning_price;
    if (!winningUserName) {
        Swal.fire({
            title: "ບໍ່ມີຜູ້ຊະນະປະການປະມູນ",
            icon:"error",
            confirmButtonText: "OK",
        });
    }else{

        Swal.fire({
            title: "ຂໍສະແດງຄວາມຍິນດີ",
            text: `${winningUserName} ແມ່ນຜູ້ຊະນະປະມູນດ້ວຍລາຄາ ${currentBid} ກີບ`,
            confirmButtonText: "OK",
        });
    }
}

function showWinningUserText() {
    $("#status").text("ປິດປະມູນ").css("color", "red");
    $("#winning-user-text, .auction-end-title").css("display", "block");
}

function handleTimeUp() {
    clearInterval(countdownInterval);
    disableInputAndButton();
    showWinningUserText();
    showWinningUserPopup();
    $("#winning-user-text").on("click", showWinningUserPopup);
}

let countdownInterval;

// Countdown timer script
function startCountdown(duration, display) {
    let timer = duration, days, hours, minutes, seconds;
    countdownInterval = setInterval(function () {
        days = parseInt(timer / (60 * 60 * 24), 10);
        hours = parseInt((timer % (60 * 60 * 24)) / (60 * 60), 10);
        minutes = parseInt((timer % (60 * 60)) / 60, 10);
        seconds = parseInt(timer % 60, 10);

        days = days < 10 ? +days : days;
        hours = hours < 10 ? +hours : hours;
        minutes = minutes < 10 ? +minutes : minutes;
        seconds = seconds < 10 ? +seconds : seconds;

        display.textContent = days + "d " + hours + "h " + minutes + "m " + seconds + "s";

        if (--timer < 0) {
            handleTimeUp();
            display.textContent = "Auction ended";
        }
    }, 1000);
}
function showErrorMessage(message) {
    Swal.fire({
      title: "ຜິດພາດ",
      text: message,
      icon: "error",
      confirmButtonText: "OK",
    });
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
    const auctionStatus = $("#status");
    const market_img = $(".market-img");
    let usernameForDisplay = "";

    console.log($("#status").text());
    if ($("#status").text() == "ປິດປະມູນ") {
      handleTimeUp();
      
  }
    function fetchUsername(userId) {
      return $.ajax({
        url: 'fetch_user.php',
        type: 'GET',
        data: { user_id: userId },
        dataType: 'json'
      });
    }
  
    async function addBidToDatabase(userId, auctionId, auctionPrice) {
      try {
        const response = await $.ajax({
          url: 'add_bid.php',
          type: 'POST',
          data: {
            user_id: userId,
            auction_id: auctionId,
            auction_price: auctionPrice
          },
          dataType: 'json'
        });
  
        if (response.status !== 'success') {
          throw new Error(response.message || 'Failed to add bid to database');
        }
      } catch (error) {
        console.error("Error adding bid to database:", error);
        throw error;
      }
    }
  
    $("#bid-form").on("submit", async function (event) {
      event.preventDefault();
  
      const userId = +$("#user_id").text();
      const auctionId = $("#auction_id").text();
      console.log(auctionId);
      try {
        const response = await fetchUsername(userId);
        usernameForDisplay = response.username;
        console.log(usernameForDisplay);
  
        const inputBidAmount = parseFloat($("#bid-amount").val());
        const bidAmount = inputBidAmount;
  
        if (inputBidAmount > (+$("#current-bid").text()) && (inputBidAmount - +$("#current-bid").text() >= +$("#minimum-bid").text())) {
          await addBidToDatabase(userId, auctionId, inputBidAmount);
          addBidToHistoryTable(bidAmount, usernameForDisplay);
          currentBid = bidAmount;
          $("#current-bid").text(currentBid);
          fetchBidHistory($("#auction_id").text())
        } else {
          showErrorMessage("ລາຄາທີ່ສະເໜີຕ້ອງສູງກວ່າລາຄາປັດຈຸບັນ");
        }
      } catch (error) {
        console.error("Error fetching :", error);
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
      let number = $("#bid-history-table tr").length; 
      const newRow = `
        <tr>
            <td>${number + 1}</td>
            <td>${bidderName}</td>
            <td>₭${bidAmount}</td>
            <td>${getCurrentDateTime()}</td>
        </tr>
      `;
      $("#bid-history-table").append(newRow);
      $("#bid-amount").val("");
    }
  
    function fetchBidHistory(auctionId) {
      $.ajax({
        url: 'fetch_bid_history.php',
        type: 'GET',
        data: { auction_id: auctionId },
        dataType: 'json',
        success: function(response) {
          populateBidHistoryTable(response);
          setCurrentBid(response);
        },
        error: function(xhr, status, error) {
          console.error("Error fetching bid history:", error);
        }
      });
    }
  
    // Function to populate the bid history table
    function populateBidHistoryTable(bidHistory) {
      const bidHistoryTable = $("#bid-history-table");
      bidHistoryTable.empty();
  
      bidHistory.forEach((bid, index) => {
        const newRow = `
          <tr>
            <td>${index + 1}</td>
            <td>${bid.username}</td>
            <td>₭${bid.auction_price}</td>
            <td>${bid.auction_date}</td>
          </tr>
        `;
        bidHistoryTable.append(newRow);
      });
    }
  
    // Function to set the current bid to the highest bid
    function setCurrentBid(bidHistory) {
      if (bidHistory.length > 0) {
        const highestBid = bidHistory[0].auction_price;
        $("#current-bid").text(highestBid);
      }
    }
  
    // Fetch bid history when the page loads
    fetchBidHistory($("#auction_id").text());

    var remainingTime = auctionData.remaining_time;
    var display = document.querySelector('#time');
    startCountdown(remainingTime, display);
});
