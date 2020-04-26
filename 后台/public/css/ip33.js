


$.IpToInt = function (ip) {
    var REG = /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/;
    var result = REG.exec(ip);
    if (!result) return "";

    return (parseInt(result[1]) << 24
        | parseInt(result[2]) << 16
        | parseInt(result[3]) << 8
        | parseInt(result[4])) >>> 0;
}

String.prototype.padLeft = function (padChar, width) {
    var ret = this;
    while (ret.length < width) {
        if (ret.length + padChar.length < width) {
            ret = padChar + ret;
        }
        else {
            ret = padChar.substring(0, width - ret.length) + ret;
        }
    }
    return ret;
};

String.prototype.padRight = function (padChar, width) {
    var ret = this;
    while (ret.length < width) {
        if (ret.length + padChar.length < width) {
            ret += padChar;
        }
        else {
            ret += padChar.substring(0, width - ret.length);
        }
    }
    return ret;
};

String.prototype.startWith = function (str) {
    var reg = new RegExp("^" + str);
    return reg.test(this);
}

String.prototype.endWith = function (str) {
    var reg = new RegExp(str + "$");
    return reg.test(this);
}

function formatHex(s) {
    var n = "";
    s = s.replace(/ ([0-9A-Fa-f]) /g, " 0$1 ");
    s = s.replace(/\s/g, "");
    for (var i = 0; i < s.length; i++) {
        n += s[i];
        if (i % 2 == 1 && i != s.length - 1) {
            n += " ";
        }
    }
    return n;
}

function hexToAscii(hex) {
    if (hex == "") {
        return "";
    }
    var ascii = "";
    var hexs = hex.split(" ");
    for (var i = 0; i < hexs.length; i++) {
        var c = String.fromCharCode("0x" + hexs[i]);
        ascii += c;
    }
    return ascii;
}

function asciiToHex(ascii) {
    if (ascii == "") {
        return "";
    }
    var hex = '';
    for (var i = 0; i < ascii.length; i++) {
        var c = ascii.charCodeAt(i);
        hex += c.toString(16).padLeft('0', 2);
        hex += " ";
    }
    return hex;
}






