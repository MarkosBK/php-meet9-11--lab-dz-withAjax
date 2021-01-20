<?php
include_once("functions.php");
$hotel = getHotelsById($_GET["hotel"]);
$images = getImagesByHotel($hotel["id"]);
$country = getCountryById($hotel["countryId"]);
$city = getCityById($hotel["cityId"]);
?>
<div class="hotelInfoContent">
    <div class="childHotelInfoContent">
        <div class="d-flex flex-column hotelInfoTitle">
            <div class="hotelName text-center"><?php echo $hotel["hotel"] ?></div>
            <div class="d-flex justify-content-center" style="font-size: 24px;">
                <?php
                for ($i = 0; $i < $hotel["stars"]; $i++) {
                    echo "&#11088;";
                }
                ?>
            </div>
        </div>
        <div class="d-flex mt-3 hotelInfo row">
            <div class="d-flex flex-column border-right p-3 hotelInf col-lg-6 col-12">
                <div class="d-flex">
                    <b>Country:&emsp;</b>
                    <span><?php echo $country["country"] ?></span>
                </div>
                <div class="d-flex mt-1">
                    <b>City:&emsp;</b>
                    <span><?php echo $city["city"] ?></span>
                </div>
                <div class="d-flex mt-1 mb-3 pb-3" style="border-bottom: 2px solid #eee;">
                    <b>Cost:&emsp;</b>
                    <span><?php echo $hotel["cost"] ?>$</span>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <b class="descHotel">Description</b>
                    <div><?php echo $hotel["info"] ?></div>
                </div>
            </div>

            <div class="d-flex flex-wrap mx-auto row p-3 hotelImgs col-lg-6 col-12">
                <?php
                for ($i = 0; $i < count($images); $i++) { ?>
                <input type="hidden" value="<?echo $images[$i]['imagepath'] ?>" id="selectImage">
                <div data-toggle="modal" data-target="#pictureModal" class="p-2 col-lg-6"
                    onclick="imageClick(this.previousSibling.previousSibling.value)">
                    <div class="divImage"
                        style=" height: 200px; cursor:pointer; background-image:<?php echo "url(" . $images[$i]['imagepath'] . ")" ?>">
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="pictureModal" tabindex="-1" aria-labelledby="pictureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="height: 100%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid p-3" style="height: 100%;">
                    <div class="divImage" id="modalImage" style="height: 100%; "></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function imageClick(e) {
    let img = document.getElementById("modalImage");
    img.style = `background-image: url(${e}); height: 100%`;
}
</script>