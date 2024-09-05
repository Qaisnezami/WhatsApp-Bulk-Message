const puppeteer = require('puppeteer');

function delay(time) {
    return new Promise(function(resolve) {
        setTimeout(resolve, time);
    });
}

async function sendWhatsAppMessage(numbers, message) {
    const browser = await puppeteer.launch({ headless: false ,
         executablePath: '/Applications/Google\ Chrome.app/Contents/MacOS/Google\ Chrome',  // change this to your chrome path
         defaultViewport: null,
        });
    const page = await browser.newPage();

    await page.goto('https://web.whatsapp.com');

    // Wait for the QR code to be scanned manually
    console.log('Scan the QR code within the next 60 seconds...');
    await delay(30000);

    for (let index = 0; index < numbers.length; index++) {
        await page.goto(`https://web.whatsapp.com/send?phone=${numbers[index]}&text=${encodeURIComponent(message)}`);

        try {
            await page.waitForSelector('button[aria-label="Send"]', { timeout: 10000 });
            await page.evaluate(() => {
                const sendButton = document.querySelector('button[aria-label="Send"]');
                if (sendButton) {
                    sendButton.click();
                }
            });
        } catch (error) {
            console.log('Send button did not appear:', error);
        }

        await delay(5000);

    }


    await browser.close();
}

// Example usage:
const numbers = process.argv[2].split(',');; // e.g., '1234567890'
const message = process.argv[3]; // e.g., 'Hello from Puppeteer!'
// sendWhatsAppMessage("+923317575455", "sdfsdfdsfsd");
sendWhatsAppMessage(numbers, message);
