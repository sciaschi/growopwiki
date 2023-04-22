class Progressbar extends HTMLElement {
    constructor() {
        super();
        // element created

        // browser calls this method when the element is added to the document
        // (can be called many times if an element is repeatedly added/removed)

        this.text = this.getAttribute('text') ?? '';
        this.steps = this.getAttribute('steps') ?? 3;
        this.currentStep = this.getAttribute('current-step') ?? 0;
        this.colors = [
            'bg-emerald-600',
            'bg-yellow-500',
            'bg-red-600',
        ]
    }

    connectedCallback() {
        let container   = document.createElement('div'),
            innerBar    = document.createElement('div'),
            text       = document.createElement('span');

        container.classList.add('w-full', 'bg-gray-200', 'rounded-full', 'dark:bg-gray-700');
        innerBar.classList.add(this.colors[this.currentStep > 0 ? this.currentStep - 1 : this.currentStep], 'text-xs', 'font-medium', 'text-blue-100', 'text-center', 'p-0.5', 'leading-none', 'rounded-full');

        console.log(((100/this.steps) * this.currentStep) + '%');

        text.innerHTML = this.text;

        innerBar.style.width = ((100/this.steps) * this.currentStep) + '%';

        text.classList.add('text-xs', 'font-medium', 'text-blue-100', 'mx-auto', 'p-0.5', 'leading-none');
        innerBar.appendChild(text);
        // innerBar.innerHTML = this.text;
        container.appendChild(innerBar);
        this.appendChild(container);
    }

    disconnectedCallback() {
        // browser calls this method when the element is removed from the document
        // (can be called many times if an element is repeatedly added/removed)
    }

    static get observedAttributes() {
        return [/* array of attribute names to monitor for changes */];
    }

    attributeChangedCallback(name, oldValue, newValue) {
        // called when one of attributes listed above is modified
    }

    adoptedCallback() {
        // called when the element is moved to a new document
        // (happens in document.adoptNode, very rarely used)
    }

    // there can be other element methods and properties
}

customElements.define("progress-bar", Progressbar);
