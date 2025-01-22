//var product = [{
   // id:1,
    //img: 'https://www.istudio.store/cdn/shop/files/macbook-air-m1-space-gray-001.jpg?v=1706069830&width=823',
    //name: 'macbook air 13 : M1',
    //price: 25550,
    //description: 'MacBook Air พลังหนักๆ บนความบางเบา โน้ตบุ๊คที่บางและเบาที่สุดของเรา วันนี้พลิกโฉมใหม่หมดในทุกด้าน ด้วยชิพ Apple M1 ที่ทำให้มี CPU เร็วขึ้นสูงสุด 3.5 เท่า และ GPU เร็วขึ้นสูงสุด 5 เท่า รวมทั้ง Neural Engine ที่ล้ำหน้าที่สุดของเรา',
    //type: 'laptop',
//}, {
  //  id: 2,
  //  img: 'https://media-cdn.bnn.in.th/348116/MacBook-Pro-M3-Space-Gray-1-square_medium.jpg',
   // name: 'macbook Pro 14: M3',
   // price: 63900,
   // description: 'MacBook Pro รุ่น 14 นิ้วพุ่งทะยานไปอีกระดับด้วยชิป M3 ซึ่งเป็นชิปสุดล้ำอันเหลือเชื่อที่พกพาความเร็วและความสามารถมาอย่างจริงจัง พร้อมแบตเตอรี่ที่ใช้งานได้นานสูงสุด 22 ชั่วโมง และจอภาพ Liquid Retina XDR อันสวยงาม ตัวเครื่องที่ทำจากอะลูมิเนียมทั้งหมดมีความทนทานเป็นเยี่ยมโดยมาในสีเทาสเปซเกรย์และสีเงิน และการอัปเดตซอฟต์แวร์ฟรียังช่วยให้อะไรต่างๆ ทำงานได้อย่างราบรื่นไปอีกนานหลายปี',
   // type: 'laptop',
//}, {
  //  id: 3,
  //  img: 'https://mediam.dotlife.store/media/catalog/product/t/h/th_ipad_10th_gen_wi-fi_blue_pdp_image_position-1b_3.jpg',
  //  name: 'iPad 10th Gen',
   // price: 17600,
  //  description: 'ได้รับการออกแบบใหม่ให้มีสีสันสดใสและอเนกประสงค์ยิ่งขึ้นกว่าครั้งไหนๆ โดยมาในดีไซน์แบบหน้าจอทั้งหมดบวกกับจอภาพ Liquid Retina ขนาด 10.9 นิ้ว และ 4 สีสวยสะดุดตา เรียกว่า iPad เป็นวิธีที่ทรงพลังในการทำนั่นทำนี่ให้เสร็จ สร้างสรรค์ และต่อติดกับทุกเรื่องอยู่เสมอ',
  //  type: 'smartphone',
//},{
  //  id: 4,
  //  img: 'https://media-cdn.bnn.in.th/431060/asus-zenbook-s-14-oled-ux5406sa-pv777wa-scandinavian-white-1-square_medium.jpg',
   // name: 'asus Zenbook S 14 OLED Scandinavian White',
   // price: 62990,
   // description: 'Asus Zenbook S 14 OLED (UX5406) สัมผัสประสบการณ์พลัง AI ที่จะเปลี่ยนแปลงโลกด้วย Zenbook S 14 ซึ่งเป็น ASUS Copilot+ PC ยุคใหม่ที่ผสมผสานดีไซน์บางเฉียบเพียง 1.1 ซม. ขับเคลื่อนด้วยโปรเซสเซอร์ Intel Core Ultra (Series 2) รุ่นล่าสุด',
   // type: 'laptop',
//},{
  //  id: 5,
   // img: 'https://media-cdn.bnn.in.th/444958/hp-omnibook-x-14-fe1012qu-glacier-silver-1-square_medium.jpg',
   // name: 'HP OmniBook X 14-fe1012QU Glacier Silver',
  //  price: 44990,
  //  description: 'HP OmniBook X โน๊ตบุ๊ค AI ขับเคลื่อนโดย Snapdragon X Plus ที่มีเอ็นจิ้น AI พร้อม NPU และด้วยพลังงานตลอดทั้งวัน ให้ประสิทธิภาพการทำงานของคุณไปสู่อีกระดับ กล้อง 5MP พร้อม Windows Studio Effects',
  //  type: 'laptop',
//},{
  //  id: 6,
  //  img: 'https://asia-exstatic-vivofs.vivo.com/PSee2l50xoirPK7y/1732593691602/e31fac37ee8b20c72373bcfe5f7f2506.png',
  //  name: 'vivo X200 Pro (16+512GB) Titanium Grey (5G)',
  ///  price: 39999,
  //  description: 'vivo  X200 Pro  รองรับ 5G    ประสบการณ์ที่ลื่นไหล ความจุที่เพิ่มขึ้นช่วยให้สลับระหว่างแอปต่างๆ ได้อย่างราบรื่นดีไซน์ที่บางเบา พกพาสะดวก มาพร้อมกล้องที่มีความคมชัดสูงรับรองการถ่ายภาพของคุณออกมาสวย และมาพร้อมกับแบตเตอรี่ขนาดใหญ่ไม่ว่าจะเล่นเกมดูหนังก็หมดห่วงเหมาะสำหรับการใช้งานได้ตลอดทั้งวัน',
   // type: 'smartphone',
//}]

var product;

$(document).ready(() => {

    $.ajax({
        method: 'get',
        url: '../ep3/api/getallproduct.php',
        success: function(response) {
            console.log(response)
            if(response.RespCode === 200) {

                product = response.Result;



                var html = '';
                for (let i = 0; i < product.length; i++) {
                     html += `<div onclick="openProductDetail(${i})" class="product-items ${product[i].type}">
                                <img class="product-img" src="./image/${product[i].img}" alt="">
                                <p style="font-size: 1.2vw;">${product[i].name}</p>
                                <p style="font-size: 1.2vw;">${numberWithCommas(product[i].price)} บาท</p>
                            </div>`;
                }
                $("#productlist").html(html);
            }
        }, error: function(err) {
            console.log(err)
        }
    })

   
})

function numberWithCommas(x) {
    if (x == null || x === undefined) return '0'; // กำหนดค่าเริ่มต้นเมื่อ x เป็น null หรือ undefined
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}

function search_product(elem) {
    //console.log('#'+elem.id);
    var value = $('#'+elem.id).val()
    console.log(value)

    var html = '';
    for (let i = 0; i < product.length; i++) {
        if(product[i].name.includes(value) ) {

            html += `<div onclick="openProductDetail(${i})" class="product-items ${product[i].type}">
                    <img class="product-img" src="./image/${product[i].img}" alt="">
                    <p style="font-size: 1.2vw;">${product[i].name}</p><br>
                    <p style="font-size: 1.2vw;">${numberWithCommas(product[i].price)} บาท</p>
                </div>`;
        }
    }
    if(html == '') {
        $("#productlist").html(`<p>ไม่เจอสินค้าที่คุณหา</p>`);
    } else {
        $("#productlist").html(html);
    }
    

}

function searchproduct(param) {
    console.log(param)
    $(".product-items").css('display', 'none')
    if(param == 'all') {
        $(".product-items").css('display', 'block')
    }
    else {
        $("."+param).css('display', 'block')
    }
} 

var productindex = 0;
function openProductDetail(index) {
    productindex = index;
    console.log(productindex)
    $('#modalDesc').css('display', 'flex')
    $("#mdd-img").attr('src','./image/' + product[index].img);
    $("#mdd-name").text(product[index].name)
    $("#mdd-price").text( numberWithCommas(product[index].price) + ' บาท')
    $("#mdd-desc").text(product[index].description)
}

function closeModal() {
    $(".modal").css('display', 'none')
}

var cart = [];
function addtocart() {
    var pass = true;

    for (let i = 0; i < cart.length; i++) {
        if( productindex == cart[i].index) {
            console.log('found same product')
            cart[i].count++;
            pass = false;
        }
    }

    if(pass) {
       var obj = {
            index: productindex,
            id: product[productindex].id,
            name: product[productindex].name,
            price: product[productindex].price,
            img: product[productindex].img,
            count: 1
       };
       //console.log(obj)
       cart.push(obj)
    }
    console.log(cart)

    Swal.fire({
        icon: 'success',
        title: 'เพิ่ม ' + product[productindex].name + ' เข้าสู่ตระกร้าแล้ว !'
    })
    $("#cartcount").css('display', 'flex').text(cart.length)
}

function openCart() {
    $('#modalCart').css('display','flex')
    rendercart();
}

function rendercart() {
    if(cart.length > 0 ) {
        var html = '';
        for (let i = 0; i < cart.length; i++) {
            html += `<div class="cartlist-items">
                        <div class="cartlist-left">
                            <img src="./image/${cart[i].img}">
                            <div class="cartlist-detail">
                                <p style="font-size: 1.5vw;">${cart[i].name}</p>
                                <p style="font-size: 1.2vw;">${ numberWithCommas (cart[i].price * cart[i].count)} บาท</p>
                            </div>
                        </div>
                        <div class="cartlist-right">
                            <p onclick="deinitems('-', ${i})" class="btnc">-</p>
                            <p id="countitems${i}" style="margin: 0 10px;">${cart[i].count}</p>
                            <p onclick="deinitems('+', ${i})" class="btnc">+</p>
                        </div>
                    </div>`;
        }
        $("#mycart").html(html)
    }
    else {
        $("#mycart").html(`<p> ยังไม่มีสินค้าในตระกร้า</p>`)
    }
}

function deinitems(actions, index) {
    if(actions == '-') {
        if(cart[index].count > 0) {
            cart[index].count--;
            $("#countitems"+index).text(cart[index].count)

            if(cart[index].count <= 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'แน่ใจใช่ไหมที่จะลบสินค้านี้?',
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'ลบ',
                    cancelButtonText: 'ยกเลิก'
                }).then((res) => {
                    if(res.isConfirmed) {
                        cart.splice(index, 1)
                        rendercart();
                        $("#cartcount").css('display', 'flex').text(cart.length)
                        if(cart.length <= 0) {
                            $("#cartcount").css('display', 'none')
                        }
                    }
                    else {
                        cart[index].count++;
                        $("#countitems"+index).text(cart[index].count)
                    }
                }) 
            }
        }
    }
    else if(actions == '+') {
        cart[index].count++; 
        $("#countitems"+index).text(cart[index].count)
    }
}



function confirmPurchase() {
    // แสดง SweetAlert เพื่อยืนยันการสั่งซื้อ
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่?',
        text: 'คุณต้องการสั่งซื้อสินค้าหรือไม่?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            // เมื่อผู้ใช้กดยืนยันการสั่งซื้อ
            purchaseItems();
        }
    });
}

function purchaseItems() {
    // จำลองข้อมูลตะกร้า (ในจริงๆจะต้องนำข้อมูลจากตะกร้า)
    var cart = [
        { name: "สินค้าชิ้นที่ 1", price: 100, img: "product1.jpg" },
        { name: "สินค้าชิ้นที่ 2", price: 200, img: "product2.jpg" }
    ];

    var customer_name = "ลูกค้าทดสอบ"; // ข้อมูลจากฟอร์มกรอกข้อมูล
    var shipping_address = "ที่อยู่ทดสอบ"; // ข้อมูลจากฟอร์มกรอกข้อมูล

    // บันทึกข้อมูลการสั่งซื้อในฐานข้อมูล
    $.ajax({
        url: './api/save_order.php',  // PHP ที่ใช้บันทึกข้อมูล
        type: 'POST',
        data: {
            customer_name: customer_name,
            shipping_address: shipping_address,
            cart_items: JSON.stringify(cart)  // ส่งข้อมูลสินค้าในรูปแบบ JSON
        },
        success: function(response) {
            // แสดง SweetAlert เมื่อสั่งซื้อสำเร็จ
            Swal.fire({
                title: 'สั่งซื้อสำเร็จ!',
                text: 'ขอบคุณสำหรับการสั่งซื้อ',
                icon: 'success',
                confirmButtonText: 'ตกลง'
            }).then(() => {
                // ล้างตะกร้า
                cart = [];  // ลบข้อมูลตะกร้า
                window.location.href = "./index.php";  // กลับไปหน้าแรก
            });
        },
        error: function() {
            alert("เกิดข้อผิดพลาดในการบันทึกข้อมูล");
        }
    });
}