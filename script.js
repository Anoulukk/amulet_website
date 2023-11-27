let currentBid = 200;
let minimumBidAmount = 100; 
let countdownMinutes = 1;
let countdownSeconds = 0;
let countdownInterval;
let winningUserName = "";

// Get references to HTML elements
const bidAmountInput = document.getElementById("bid-amount");
const currentBidDisplay = document.getElementById("current-bid");
const minimumBidDisplay = document.getElementById("minimum-bid");
const bidList = document.getElementById("bid-list");
const placeBidButton = document.getElementById("place-bid");
const countdownDisplay = document.getElementById("countdown");
const winningUserText = document.getElementById("winning-user-text");
const auctionEndTitle = document.querySelector(".auction-end-title");
const popup = document.getElementById("popup");
const largeImage = document.getElementById("largeImage");
const smallImages = document.querySelectorAll(".img-small");
const finalBidDisplay = document.getElementById("final-bid");
const AuctionStatus = document.getElementById("status");
// Add a submit event listener to the form
const bidButton = document.getElementById("bid-form");
bidButton.addEventListener("submit", handleFormSubmit);

currentBidDisplay.textContent = currentBid;
minimumBidDisplay.textContent = `$${minimumBidAmount}`;
// Add click event listeners to the small images
smallImages.forEach((smallImage) => {
    smallImage.addEventListener("click", () => {
        const newImageSrc = smallImage.getAttribute("data-src");
        // Set the large image source to the new image
        largeImage.src = newImageSrc;
    });
});

function updateCountdown() {
    let days = Math.floor(countdownMinutes / (60 * 24));
    let hours = Math.floor((countdownMinutes % (60 * 24)) / 60);
    let minutes = countdownMinutes % 60;
    let seconds = countdownSeconds;

    if (days > 0) {
        countdownDisplay.textContent = `${days} ວັນ`;
    } else {
        countdownDisplay.textContent = `${hours}:${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;
    }

    if (countdownMinutes < 60) {
        countdownDisplay.style.color = "red";
    } else {
        countdownDisplay.style.color = "";
    }
}


function showErrorMessage(message) {
    Swal.fire({
        title: 'Error',
        text: message,
        icon: 'error',
        confirmButtonText: 'OK'
    });
}
function disableInputAndButton() {
    bidAmountInput.disabled = true;
    placeBidButton.disabled = true;
}
// Function to show the popup with the winning user's name
function showWinningUserPopup() {
    Swal.fire({
        title: 'Congratulations',
        text: `${winningUserName} ແມ່ນຜູ້ຊະນະປະມູນດ້ວຍລາຄາ ${currentBid} ກີບ`,
        confirmButtonText: 'OK'
    });
}

// Function to show the winning user text
function showWinningUserText() {
    AuctionStatus.innerText = "ປິດປະມູນ";
    AuctionStatus.style.color = "red";
    // winningUserText.style.color = "#e1ad21";
    winningUserText.style.display = "block"; // Show the text
    auctionEndTitle.style.display = "block";

}

// Function to handle the time-up event
function handleTimeUp() {
    clearInterval(countdownInterval); // Stop the countdown timer

    // Disable input and button after the time is up
    disableInputAndButton();

    // Show the winning user text
    showWinningUserText();

    // Add an event listener to the text to show the SweetAlert2 popup
    winningUserText.addEventListener("click", function () {
        showWinningUserPopup();
    });
}

// Modify the startCountdown function to call handleTimeUp when the time is up
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
    }, 100); // Use 1000 milliseconds (1 second) as the interval
}


startCountdown(); 


// Function to handle form submission
function handleFormSubmit(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the bid amount and round it to the nearest multiple of 100
    const inputBidAmount = parseFloat(bidAmountInput.value);
    
    if (!isNaN(inputBidAmount)) { // Check if the input is a valid number
        const bidAmount = Math.round(inputBidAmount / 100) * 100;

    if (bidAmount > currentBid) {
        addBidToHistoryTable(bidAmount, "John Doe");
        currentBid = bidAmount;
        currentBidDisplay.textContent = currentBid;
        // Clear the bid input field
    } else {
        showErrorMessage("Bid must be higher than the current bid.");
    }
    }
}
let number = 1;

function getCurrentDateTime() {
    const now = new Date();
    const year = now.getFullYear();
    const month = now.getMonth() + 1; // Months are 0-indexed, so add 1.
    const day = now.getDate();
    const hours = now.getHours();
    const minutes = now.getMinutes();
    const amOrPm = hours >= 12 ? "PM" : "AM";
    const formattedHours = hours % 12 || 12; // Convert to 12-hour format.
    const formattedMinutes = minutes.toString().padStart(2, '0'); // Ensure two-digit minutes;

    return `${year}-${month}-${day} ${formattedHours}:${formattedMinutes} ${amOrPm}`;
}
function addBidToHistoryTable(bidAmount, bidderName) {
    const bidHistoryTable = document.getElementById("bid-history-table");
    const newRow = document.createElement("tr");
    newRow.innerHTML = `
        <td>${number}</td>
        <td>${bidderName}</td>
        <td>$${bidAmount}</td>
        <td>${getCurrentDateTime()}</td>
    `;
    
    bidHistoryTable.appendChild(newRow);
    number++;
    
    winningUserName = bidderName;
    bidAmountInput.value = "";

}

// Example usage:
// Add a new bid to the bid history table with bidder name, bid amount, and bid time
addBidToHistoryTable(150, "John Doe");
addBidToHistoryTable(200, "Alice Smith");

