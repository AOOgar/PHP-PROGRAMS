<?php
/**
 * This file is part of phpRegister.
 *
 * phpRegister is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

 * phpRegister is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * See: http://www.gnu.org/licenses/
 * Thank you for your help and support: https://phpregister.org/help

 * Creation: 2019 Vincent Marguerit
 * Last modification:
 */ 

function show_about() {
    global $config;

    echo '
<div class="container py-3 py-sm-5">
    <h4 class="spacing-2 underline-mytheme mb-4 mb-sm-5">'.lg('About us', 'Global').'</h4>
    <div class="row">
        <div class="col-sm-7">

<p>Unde Rufinus ea tempestate praefectus praetorio ad discrimen trusus est ultimum. ire enim ipse compellebatur ad militem, quem exagitabat inopia simul et feritas, et alioqui coalito more in ordinarias dignitates asperum semper et saevum, ut satisfaceret atque monstraret, quam ob causam annonae convectio sit impedita.</p>

<p>Cum saepe multa, tum memini domi in hemicyclio sedentem, ut solebat, cum et ego essem una et pauci admodum familiares, in eum sermonem illum incidere qui tum forte multis erat in ore. Meministi enim profecto, Attice, et eo magis, quod P. Sulpicio utebare multum, cum is tribunus plebis capitali odio a Q. Pompeio, qui tum erat consul, dissideret, quocum coniunctissime et amantissime vixerat, quanta esset hominum vel admiratio vel querella.</p>
        </div>
        <div class="col-sm-5 text-center">
            <img class="border border-info rounded-lg shadow" style="width:95%;max-width:400px;" src="'.$config['ImagesURL'].'about-us/london-street-by-night.jpg">
        </div>
    </div>
    <p class="underline-mytheme my-3 my-sm-5"></p>
    <div class="d-flex justify-content-between myicons">
       <i class="fa fa-bank text-info ml-2 ml-sm-5"></i>
       <i class="fa fa-bar-chart text-info"></i>
       <i class="fa fa-cloud text-info"></i>
       <i class="fa fa-compass text-info mr-2 mr-sm-5"></i>
    </div>
    <p class="underline-mytheme my-3 my-sm-5"></p>

    <div class="row">
        <div class="col-sm-5">
            <img class="" style="width:95%;max-width:400px;" src="'.$config['ImagesURL'].'about-us/guy.png">
        </div>
        <div class="col-sm-7">
<p>Quo cognito Constantius ultra mortalem modum exarsit ac nequo casu idem Gallus de futuris incertus agitare quaedam conducentia saluti suae per itinera conaretur, remoti sunt omnes de industria milites agentes in civitatibus perviis.</p>
<p>Sin autem ad adulescentiam perduxissent, dirimi tamen interdum contentione vel uxoriae condicionis vel commodi alicuius, quod idem adipisci uterque non posset. Quod si qui longius in amicitia provecti essent, tamen saepe labefactari, si in honoris contentionem incidissent; pestem enim nullam maiorem esse amicitiis quam in plerisque pecuniae cupiditatem, in optimis quibusque honoris certamen et gloriae; ex quo inimicitias maximas saepe inter amicissimos exstitisse.</p>
        </div>
    </div>
</div>';

}

?>
