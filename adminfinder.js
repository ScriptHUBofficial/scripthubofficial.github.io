const axios = require('axios');
const fs = require('fs');

async function admin_panel_finder(target) {
  console.clear();

  const wordlist = fs.readFileSync('adminler.txt', 'utf-8').split('\n');
  const foundAdmins = [];

  class AdminThread {
    constructor(admin) {
      this.admin = admin;
    }

    async run() {
     
      
     try {
  const url = `https://${target}/${this.admin}`;
  const response = await axios.get(url, { maxRedirects: 0 });
  if (response.status === 200) {
    console.log(`[+] ${url} bulundu!`); // Yeşil renkte yazdır
    foundAdmins.push(url);
  } 
} catch (error) {
  const url = `https://${target}/${this.admin}`; // Bulunamayan URL'yi elde et
  console.log(`[-] ${url} bulunamadı!`); // Kırmızı renkte yazdır
  foundAdmins.push(url);
}




    }
  }

  const threads = [];
  for (const admin of wordlist) {
    const t = new AdminThread(admin);
    threads.push(t.run());
  }

  await Promise.allSettled(threads);

  const filteredAdmins = foundAdmins.filter(Boolean);

  if (filteredAdmins.length > 0) {
    fs.writeFileSync('adminler_bulunan.txt', filteredAdmins.join('\n'));
    console.clear();
  } else {
    console.log('\x1b[31m%s\x1b[0m', '\nHiçbir Admin Paneli Bulunamadı!');
  }
}

const target = process.argv[2];
admin_panel_finder(target);
