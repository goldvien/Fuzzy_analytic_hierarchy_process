

function TrokutniFuzzyBroj(v1,v2,v3)
{
	this.v1 = v1;
	this.v2 = v2;
	this.v3 = v3;

	this.inverz = function()
	{
		var v1 = 1 / this.v1;
		var v2 = 1 / this.v2;
		var v3 = 1 / this.v3;
		var tfb = new TrokutniFuzzyBroj(Math.round(v1*100) / 100, Math.round(v2*100)/100, Math.round(v3*100)/100);
		return tfb;
	}

	this.toString = function()
	{
		var rez = "(" + this.v1 + ", " + this.v2 + ", " + this.v3 + ")";
		return rez;
	}
}

var TrokutniFuzzyBrojEnum = Object.freeze({U_potpunosti_jednako:  {vrijednost: new TrokutniFuzzyBroj(1,1,1),         toString: "U potpunosti jednako"},
										   Jednako_važno:         {vrijednost: new TrokutniFuzzyBroj(0.5,1,1.66),    toString: "Jednako važno"},
										   Umjereno_važnije: 	  {vrijednost: new TrokutniFuzzyBroj(1,1.5,2),       toString: "Umjereno važnije"},
										   Dosta_važnije: 	      {vrijednost: new TrokutniFuzzyBroj(1.5,2,2.5),	 toString: "Dosta važnije"},
										   Jako_važnije: 		  {vrijednost: new TrokutniFuzzyBroj(2,2.5,3),		 toString: "Jako važnije"},
										   Izrazito_važnije:      {vrijednost: new TrokutniFuzzyBroj(2.5, 3, 3.5),   toString: "Izrazito važnije"}});
var TrokutniFuzzyBrojEnumDict = {};
TrokutniFuzzyBrojEnumDict[0] = TrokutniFuzzyBrojEnum.U_potpunosti_jednako;
TrokutniFuzzyBrojEnumDict[1] = TrokutniFuzzyBrojEnum.Jednako_važno;
TrokutniFuzzyBrojEnumDict[2] = TrokutniFuzzyBrojEnum.Umjereno_važnije;
TrokutniFuzzyBrojEnumDict[3] = TrokutniFuzzyBrojEnum.Dosta_važnije;
TrokutniFuzzyBrojEnumDict[4] = TrokutniFuzzyBrojEnum.Jako_važnije;
TrokutniFuzzyBrojEnumDict[5] = TrokutniFuzzyBrojEnum.Izrazito_važnije;
