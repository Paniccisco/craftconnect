

function showCategories(target) {
  var categories = document.querySelector('#categories');
  var categoryButtons = categories.querySelectorAll('.category');

  categories.classList.add('show');

  categoryButtons.forEach(function(category) {
    if (category.classList.contains(target)) {
      category.style.display = category.style.display === 'none' ? 'block' : 'none';
    } else {
      category.style.display = 'none';
    }
  });
}

function openCategory(location) {
  var locationLink;

  switch (location) {
    case 'Palawan':
      locationLink = 'https://www.google.com/maps/place/Coron,+Palawan/@12.0179348,119.9344385,10z/data=!3m1!4b1!4m6!3m5!1s0x33ba1ef225b0d675:0x68841ab9a85e968e!8m2!3d12.0489179!4d120.1519011!16zL20vMDJocW5k?hl=en-GB&entry=ttu';
      break;
    case 'Camiguin':
      locationLink = 'https://www.google.com/maps/place/White+Island/@9.2517546,124.6494219,15z/data=!4m10!1m2!2m1!1scamiguin+white+island!3m6!1s0x33007b1da1f0c8e9:0x549a82c91de23a06!8m2!3d9.2579805!4d124.6555547!15sChVjYW1pZ3VpbiB3aGl0ZSBpc2xhbmSSARJ0b3VyaXN0X2F0dHJhY3Rpb27gAQA!16s%2Fg%2F11c1s4b_pb?hl=en-GB&entry=ttu';
      break;
    case 'Sagada':
      locationLink = 'https://www.google.com/maps?output=search&q=sagada+rice+terraces&entry=mc&sa=X&ved=2ahUKEwi4h8vhq4SAAxW9Z2wGHSWYDyAQ0pQJegQIDBAB';
      break;
    case 'Manila':
      locationLink = 'https://www.google.com/maps/place/Intramuros,+Manila,+1002+Metro+Manila/@14.5891952,120.9656417,15z/data=!3m1!4b1!4m6!3m5!1s0x3397ca3d1375e1fb:0x49ebfa658c0ba08!8m2!3d14.5895972!4d120.9747258!16zL20vMDNiNWps?hl=en-GB&entry=ttu';
      break;
    case 'Baguio':
      locationLink = 'https://www.google.com/maps?output=search&q=baguio+stone+kingdom&entry=mc&sa=X&ved=2ahUKEwi309uRrISAAxUuSWwGHQ79DSkQ0pQJegQIDBAB';
      break;
    case 'Batanes':
      locationLink = 'https://www.google.com/maps/place/Basco+Lighthouse/@20.3952713,121.8480439,12z/data=!4m10!1m2!2m1!1sbatanes+lighthouse!3m6!1s0x3479c044977630df:0x910687f26f3cc92b!8m2!3d20.451533!4d121.9641531!15sChJiYXRhbmVzIGxpZ2h0aG91c2VaFCISYmF0YW5lcyBsaWdodGhvdXNlkgETaGlzdG9yaWNhbF9sYW5kbWFya-ABAA!16s%2Fg%2F11bc6ry80w?entry=ttu';
      break;
    case 'Albay':
      locationLink = 'https://www.google.com/maps/place/Mayon+Volcano/@13.2548312,123.6686028,14z/data=!3m1!4b1!4m6!3m5!1s0x33a1a9954fa1731f:0xdff71d3eddd0ea0d!8m2!3d13.254832!4d123.6861124!16zL20vMDFtMDdk?entry=ttu';
      break;
    case 'Pangasinan':
      locationLink = 'https://www.google.com/maps/place/Bolinao+Falls+1/@16.3059032,119.8220645,14z/data=!4m10!1m2!2m1!1spangasinan+bolinao+falls!3m6!1s0x3393c8bf9609f315:0x805181ea74a8c084!8m2!3d16.3059032!4d119.8601733!15sChhwYW5nYXNpbmFuIGJvbGluYW8gZmFsbHOSARJ0b3VyaXN0X2F0dHJhY3Rpb27gAQA!16s%2Fg%2F1hdzvgm5y?entry=ttu';
      break;
    case 'Cebu':
      locationLink = 'https://www.google.com/maps/place/Monastery+of+the+Holy+Eucharist/@9.9798109,123.5973967,17z/data=!4m10!1m2!2m1!1ssimala+shrine+cebu!3m6!1s0x33abda8c0e6d8379:0x62bd6146c93b1c42!8m2!3d9.9801728!4d123.5995067!15sChJzaW1hbGEgc2hyaW5lIGNlYnVaFCISc2ltYWxhIHNocmluZSBjZWJ1kgEPY2F0aG9saWNfY2h1cmNo4AEA!16s%2Fg%2F11p5qqk_zl?entry=ttu';
      break;
    case 'Bohol':
      locationLink = 'https://www.google.com/maps?output=search&q=can+umantad+falls&entry=mc&sa=X&ved=2ahUKEwjinfrJrYSAAxVdbmwGHQmDDzQQ0pQJegQIDRAB';
      break;
    case 'Boracay':
      locationLink = 'https://www.google.com/maps/place/Shangri-La+Boracay/@11.9874249,121.9040401,17z/data=!3m1!4b1!4m9!3m8!1s0x33a53c79fb9011c1:0xdcecb532f50053e5!5m2!4m1!1i2!8m2!3d11.9874249!4d121.9062288!16s%2Fg%2F1trqdr4q?hl=en-GB&entry=ttu';
      break;
    case 'Siargao':
      locationLink = 'https://www.google.com/maps?q=siargao&source=lmns&entry=mt&bih=939&biw=1680&hl=en-GB&sa=X&ved=2ahUKEwiCttOerYSAAxV0jmMGHbcBD7IQ_AUoAXoECAEQAQ';
      break;
  }

  if (locationLink) {
    window.open(locationLink, '_blank');
  }
}

var testimonials = document.querySelectorAll('.testimonial');
var currentTestimonial = 0;

function showNextTestimonial() {
  testimonials[currentTestimonial].classList.remove('active');
  currentTestimonial = (currentTestimonial + 1) % testimonials.length;
  testimonials[currentTestimonial].classList.add('active');
}

setInterval(showNextTestimonial, 5000);


 
  document.querySelector(".privacy-policy-link").addEventListener("click", function(event) {
    event.preventDefault();
    var privacyPolicy = `Privacy Policy

We value your privacy. This policy outlines how we collect, use, and protect your information.

1. Information We Collect:
We collect your name, email, phone, and payment details.

2. How We Use Your Information:
We process bookings, personalize your experience, and send relevant updates.

3. Data Security:
We use industry-standard security measures to protect your information.

For any questions or concerns about our Privacy Policy, please contact us.

Thank you for trusting us with your information. We prioritize your privacy.`;
    
    alert(privacyPolicy);
  });

  document.querySelector(".terms-of-service-link").addEventListener("click", function(event) {
    event.preventDefault();
    var termsOfService = `Terms of Service

By accessing and using our website, you agree to comply with these terms of service. All content on our website is protected by intellectual property laws. You are responsible for maintaining the confidentiality of your account and agree not to engage in activities that violate laws or infringe upon the rights of others. We strive to provide accurate information but are not liable for any damages. By using our website, you consent to our Privacy Policy. We may update these terms without notice.

For questions or concerns about our Terms of Service, please contact us.

Thank you for using our services and agreeing to these terms.`;

    alert(termsOfService);
  });

  

  

  

  