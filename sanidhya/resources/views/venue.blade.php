@include("inc_sanidhya.header")


<style>
  	*, *:before, *:after {
  box-sizing: border-box !important;
}
::selection {
  background-color: #eee;
}
::-moz-selection {
  background-color: #eee;
}

.theatre {
  margin: 50px 100px;
  width: 100%;
  max-width: 700px;
  border-radius: 5px;
  background-color: #fff;
  padding: 20px 10px;
  box-shadow: 0px 0px 17px -4px #000;
}
.screen-side {
  text-align: center;
}
.screen-side .screen {
  height: 25px;
  margin: 0 20px;
  border-radius: 50%;
  box-shadow: 0px -3px 0px 1px #ccc;
  color: #ccc;
}
.screen-side .select-text {
  color: #969696;
}
.exit {
  position: relative;
  height: 50px;
}
.exit:before, .exit:after {
  content: "EXIT";
  font-size: 14px;
  line-height: 18px;
  padding: 0px 5px;
  font-family: "Arial Narrow", Arial, sans-serif;
  display: block;
  position: absolute;
  background: #81c784;
  color: white;
  top: 50%;
  transform: translate(0, -50%);
}
.exit:before {
  left: 0;
}
.exit:after {
  right: 0;
}
ol {
  list-style: none;
  padding: 0;
  margin: 0;
}
.seats {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: flex-start;
}
.seat {
  display: flex;
  flex: 0 0 10%;
  padding: 5px;
  position: relative;
}

.seat input[type="checkbox"] {
  position: absolute;
  opacity: 0;
}
.seat input[type="checkbox"]:checked + label {
  background: #bada55;
  -webkit-animation-name: rubberBand;
  animation-name: rubberBand;
  animation-duration: 300ms;
  animation-fill-mode: both;
}
.seat input[type="checkbox"]:disabled + label {
  background: #ddd;
  text-indent: -9999px;
  overflow: hidden;
}
.reserved input[type="checkbox"]:disabled + label {
  background: #dbbe23;
  text-indent: -9999px;
  overflow: hidden;
}
.seat input[type="checkbox"]:disabled + label:after {
  content: "X";
  text-indent: 0;
  position: absolute;
  top: 4px;
  left: 50%;
  transform: translate(-50%, 0%);
}
.reserved input[type="checkbox"]:disabled + label:after {
  content: "R";
  text-indent: 0;
  position: absolute;
  top: 4px;
  left: 50%;
  transform: translate(-50%, 0%);
}
.seat input[type="checkbox"]:disabled + label:hover {
  box-shadow: none;
  cursor: not-allowed;
}
.seat label {
  display: block;
  position: relative;
  width: 100%;
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  line-height: 1.5rem;
  padding: 4px 0;
  color: #fff;
  background: #26a69a;
  border-radius: 2px;
  animation-duration: 300ms;
  animation-fill-mode: both;
  transition-duration: 300ms;
}
.seat label:hover {
  cursor: pointer;
  box-shadow: 0px 0 7px 3px #ccc;
}
@-webkit-keyframes rubberBand {
  0% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
  30% {
    -webkit-transform: scale3d(1.25, 0.75, 1);
    transform: scale3d(1.25, 0.75, 1);
  }
  40% {
    -webkit-transform: scale3d(0.75, 1.25, 1);
    transform: scale3d(0.75, 1.25, 1);
  }
  50% {
    -webkit-transform: scale3d(1.15, 0.85, 1);
    transform: scale3d(1.15, 0.85, 1);
  }
  65% {
    -webkit-transform: scale3d(0.95, 1.05, 1);
    transform: scale3d(0.95, 1.05, 1);
  }
  75% {
    -webkit-transform: scale3d(1.05, 0.95, 1);
    transform: scale3d(1.05, 0.95, 1);
  }
  100% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}
@keyframes rubberBand {
  0% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
  30% {
    -webkit-transform: scale3d(1.25, 0.75, 1);
    transform: scale3d(1.25, 0.75, 1);
  }
  40% {
    -webkit-transform: scale3d(0.75, 1.25, 1);
    transform: scale3d(0.75, 1.25, 1);
  }
  50% {
    -webkit-transform: scale3d(1.15, 0.85, 1);
    transform: scale3d(1.15, 0.85, 1);
  }
  65% {
    -webkit-transform: scale3d(0.95, 1.05, 1);
    transform: scale3d(0.95, 1.05, 1);
  }
  75% {
    -webkit-transform: scale3d(1.05, 0.95, 1);
    transform: scale3d(1.05, 0.95, 1);
  }
  100% {
    -webkit-transform: scale3d(1, 1, 1);
    transform: scale3d(1, 1, 1);
  }
}
.rubberBand {
  -webkit-animation-name: rubberBand;
  animation-name: rubberBand;
}
</style>
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <h3>Mumbai Venue</h3>
                </div>
                <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Venue</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
<div class="theatre">
    
  <div class="screen-side">
    <div class="screen">Stage</div><br><br>
  </div>
  <ol class="cabin">
    <li class="row row--1">
      <ol class="seats" type="A">
        <li class="seat">
          <input type="checkbox" disabled id="1A" />
          <label for="1A">P1</label>
        </li>
        <li class="seat">
          <input type="checkbox" disabled id="1B" />
          <label for="1B">P2</label>
        </li>
        <li class="seat">
          <input type="checkbox" disabled id="1C" />
          <label for="1C">P3</label>
        </li>
        <li class="seat reserved">
          <input type="checkbox" disabled id="1D" />
          <label for="1D">P4</label>
        </li>
        <li class="seat reserved">
          <input type="checkbox" disabled id="1E" />
          <label for="1E">P5</label>
        </li>
        <li class="seat reserved">
          <input type="checkbox" disabled id="1F" />
          <label for="1F">P6</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">P7</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">P8</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">P9</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">P10</label>
        </li>
        
        
      </ol>
    </li>
    <li class="row row--1">
      <ol class="seats" type="A">
        <li class="seat">
          <input type="checkbox" id="1A" />
          <label for="1A">P11</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1B" />
          <label for="1B">P12</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1C" />
          <label for="1C">P13</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1D" />
          <label for="1D">P14</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1E" />
          <label for="1E">P15</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">P16</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">P17</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">P18</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">P19</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">P20</label>
        </li>
        
        
      </ol>
    </li>
  
  </ol>



  <hr>
 
  
  <ol class="cabin">
    <li class="row row--1">
      <ol class="seats" type="A">
        <li class="seat">
          <input type="checkbox" disabled id="1A" />
          <label for="1A">G1</label>
        </li>
        <li class="seat">
          <input type="checkbox" disabled id="1B" />
          <label for="1B">G2</label>
        </li>
        <li class="seat">
          <input type="checkbox" disabled id="1C" />
          <label for="1C">G3</label>
        </li>
        <li class="seat reserved">
          <input type="checkbox"  id="1D" />
          <label for="1D">G4</label>
        </li>
        <li class="seat reserved">
          <input type="checkbox"  id="1E" />
          <label for="1E">G5</label>
        </li>
        <li class="seat reserved">
          <input type="checkbox"  id="1F" />
          <label for="1F">G6</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">G7</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">G8</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">G9</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">G10</label>
        </li>
        
        
      </ol>
    </li>
    <li class="row row--1">
      <ol class="seats" type="A">
        <li class="seat">
          <input type="checkbox" id="1A" />
          <label for="1A">G11</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1B" />
          <label for="1B">G12</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1C" />
          <label for="1C">G13</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1D" />
          <label for="1D">G14</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1E" />
          <label for="1E">G15</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">G16</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">G17</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">G18</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">G19</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">G20</label>
        </li>
        
        
      </ol>
    </li>
  
  </ol>


  <hr>
 
  
  <ol class="cabin">
    <li class="row row--1">
      <ol class="seats" type="A">
        <li class="seat">
          <input type="checkbox"  id="1A" />
          <label for="1A">S1</label>
        </li>
        <li class="seat">
          <input type="checkbox"  id="1B" />
          <label for="1B">S2</label>
        </li>
        <li class="seat">
          <input type="checkbox"  id="1C" />
          <label for="1C">S3</label>
        </li>
        <li class="seat reserved">
          <input type="checkbox"  id="1D" />
          <label for="1D">S4</label>
        </li>
        <li class="seat reserved">
          <input type="checkbox"  id="1E" />
          <label for="1E">S5</label>
        </li>
        <li class="seat reserved">
          <input type="checkbox"  id="1F" />
          <label for="1F">S6</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">S7</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">S8</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">S9</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">S10</label>
        </li>
        
        
      </ol>
    </li>
    <li class="row row--1">
      <ol class="seats" type="A">
        <li class="seat">
          <input type="checkbox" id="1A" />
          <label for="1A">S11</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1B" />
          <label for="1B">S12</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1C" />
          <label for="1C">S13</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1D" />
          <label for="1D">S14</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1E" />
          <label for="1E">S15</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">S16</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">S17</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">S18</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">S19</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">S20</label>
        </li>
        
        
      </ol>
    </li>
  
  </ol>

  <hr>
 
  
  <ol class="cabin">
    <li class="row row--1">
      <ol class="seats" type="A">
        <li class="seat">
          <input type="checkbox"  id="1A" />
          <label for="1A">R1</label>
        </li>
        <li class="seat">
          <input type="checkbox"  id="1B" />
          <label for="1B">R2</label>
        </li>
        <li class="seat">
          <input type="checkbox"  id="1C" />
          <label for="1C">R3</label>
        </li>
        <li class="seat reserved">
          <input type="checkbox"  id="1D" />
          <label for="1D">R4</label>
        </li>
        <li class="seat reserved">
          <input type="checkbox"  id="1E" />
          <label for="1E">R5</label>
        </li>
        <li class="seat reserved">
          <input type="checkbox"  id="1F" />
          <label for="1F">R6</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">R7</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">R8</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">R9</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">R10</label>
        </li>
        
        
      </ol>
    </li>
    <li class="row row--1">
      <ol class="seats" type="A">
        <li class="seat">
          <input type="checkbox" id="1A" />
          <label for="1A">R11</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1B" />
          <label for="1B">R12</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1C" />
          <label for="1C">R13</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1D" />
          <label for="1D">R14</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1E" />
          <label for="1E">R15</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">R16</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">R17</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">R18</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">R19</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="1F" />
          <label for="1F">R20</label>
        </li>
        
        
      </ol>
    </li>
  
  </ol>
</div></div>


@include("inc_sanidhya.footer")

