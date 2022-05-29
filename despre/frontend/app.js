function INFO(e) {
  const title = "Proiect Aplicație Web";
  const content = `UTM - Informatică, anul II.<br>
    Temă - Proiect la TEHNOLOGII WEB.<br>
    Sudent: Dinu Eugen Cosmin
    `;
  const onClose = (e) => console.log("Closed!");
  const aboutMe = new Page(title, content, onClose);
  main.appendChild(aboutMe.createElement());
}

const Element = libraryGet("Element");
const Button = libraryGet("Button");
const Wrap = libraryGet("Wrap");
const SimpleMenu = libraryGet("SimpleMenu");
const Menu = libraryGet("Menu");
const Page = libraryGet("Page");

const main = document.getElementById("main");
main.style.maxWidth = "600px";
main.style.position = "relative";

const menu = new Menu(
  "Aplicație Web",
  { Exemplu_forme_dinamice_JS, INFO },
  (e) => {
    const thisMenu = e.target.parentNode.parentNode;
    const bodyMenu = thisMenu.childNodes[1];
    const subMenu = bodyMenu.childNodes[0];
    subMenu && bodyMenu.removeChild(subMenu);
    e.target.style.visibility = "hidden";
  }
).createElement();

const body = new Wrap().createElement();
main.appendChild(menu);
main.appendChild(body);

function Exemplu_forme_dinamice_JS(e) {
  const circleShape = new Element("span", "&#9685;");
  const squareShape = new Element("span", "&#9712;");
  const shapesMenu = new Menu(
    "Adaugă o formă",
    {
      "&#9685;": (e) => body.appendChild(circleShape.createElement()),
      "&#9712;": (e) => body.appendChild(squareShape.createElement()),
    },
    (e) => {
      const menu = e.target.parentNode.parentNode;
      menu.parentNode.removeChild(menu);
    }
  );
  main.appendChild(shapesMenu.createElement());
}

//******************** Library ******************** */
function libraryGet(required) {
  const library = new Map();

  class Element {
    constructor(tag, innerHTML) {
      this._tag = tag;
      this._innerHTML = innerHTML;
      // this._onClick = e => console.log(e.target);
      this._clicked = 0;
      this._style = {};
      this._props = {};
      this._children = [];
    }
    setChildren(children) {
      for (const child of children) {
        this._children.push(child);
      }
      return this;
    }
    appendChild(child) {
      this._children.push(child);
      return this;
    }
    setProps(props) {
      for (const p in props) {
        this._props[p] = props[p];
      }
      return this;
    }
    setStyle(style) {
      for (const styleProp in style) this._style[styleProp] = style[styleProp];
      return this;
    }
    setOnClick(userOnClick) {
      this._onClick = userOnClick;
      return this;
    }
    _onClickDecorator(userOnClick) {
      return (event) => {
        userOnClick && userOnClick(event);
        // limit to [0,10]
        this._clicked = (this._clicked % 10) + 1;
        event.target.clicked = this._clicked;
      };
    }
    createElement() {
      const element = document.createElement(this._tag);
      if (this._innerHTML) {
        element.innerHTML = this._innerHTML;
      }
      element.addEventListener("click", this._onClickDecorator(this._onClick));
      for (const k in this._style) element.style[k] = this._style[k];
      for (const p in this._props) element[p] = this._props[p];
      if (this._children.length > 0) {
        const frag = new DocumentFragment();
        for (const child of this._children) {
          frag.appendChild(child);
        }
        element.appendChild(frag);
      }
      element.clicked = this._clicked;
      return element;
    }
  }

  class Wrap extends Element {
    constructor() {
      super("div", "");
      this.setStyle({
        display: "flex",
        justifyContent: "center",
        alignItems: "end",
        width: "100%",
      });
    }
  }

  class Button extends Element {
    constructor(innerHTML) {
      super("button", innerHTML);
      this.setStyle({
        border: "thin solid black",
        fontSize: "x-large",
      });
    }
  }

  class SimpleMenu extends Element {
    constructor(menuFunctions) {
      super("div");
      const ul = new Element("ul");
      const items = new DocumentFragment();
      let id = 1;
      for (const funcName in menuFunctions) {
        const li = new Element("li");
        li.setProps({ id: id++ });
        const menuButton = new Button(funcName);
        menuButton.setStyle({
          width: "100%",
          fontSize: "large",
        });
        menuButton.setOnClick(menuFunctions[funcName]);
        li.appendChild(menuButton.createElement());
        items.appendChild(li.createElement());
      }
      ul.appendChild(items);
      ul.setStyle({
        listStyle: "none",
        paddingInlineStart: "0px",
        backgroundColor: "whitesmoke",
        margin: "0px",
        padding: "10px",
      });
      this.setStyle({
        width: "100%",
        display: "flex",
      });
      this.appendChild(ul.createElement());
    }
  }

  class Menu extends Element {
    constructor(textMsg, items, onClose) {
      super("div");
      const header = new Wrap().setStyle({ backgroundColor: "#fafafa" });
      const body = new Wrap().createElement();
      const menu = new SimpleMenu(items).createElement();

      const mainBtn = new Button("&#9776;");
      const text = new Element("span", textMsg)
        .setStyle({ width: "100%", textAlign: "center" })
        .createElement();
      const closeBtn = new Button("x")
        .setStyle({ visibility: "hidden" })
        .setOnClick(onClose)
        .setProps({ id: "closebtn" })
        .createElement();

      mainBtn.setOnClick((e) => {
        // remove menu on second click
        if (body.contains(menu)) {
          body.removeChild(menu);
          closeBtn.style.visibility = "hidden";
        } else {
          body.appendChild(menu);
          closeBtn.style.visibility = "visible";
        }
      });
      header.setChildren([mainBtn.createElement(), text, closeBtn]);
      this.setChildren([header.createElement(), body]);
    }
  }

  class Page extends Element {
    constructor(title, content, onClose) {
      super("div");
      this.setStyle({
        position: "absolute",
        top: "0",
        width: "100%",
        height: "100%",
        backgroundColor: "white",
      });
      const header = new Wrap();
      const titleElem = new Element("h3", title).setStyle({
        width: "100%",
        textAlign: "center",
      });
      const closeBtn = new Button("x").setOnClick((e) => {
        onClose(e);
        const page = e.target.parentNode.parentNode;
        page.parentNode.removeChild(page);
      });
      header.setChildren([titleElem.createElement(), closeBtn.createElement()]);
      const body = new Element("p", content);
      this.setChildren([header.createElement(), body.createElement()]);
    }
  }

  library.set("Element", Element);
  library.set("Button", Button);
  library.set("Wrap", Wrap);
  library.set("SimpleMenu", SimpleMenu);
  library.set("Menu", Menu);
  library.set("Page", Page);

  return library.get(required);
}
//******************** Library END ******************** */
