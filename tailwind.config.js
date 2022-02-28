module.exports = {
    content: [
        './**/*.vue'
    ],
    theme  : {
        extend: {
            backgroundColor: {
                page        : 'var(--page-background-color)',
                component   : 'var(--component-background-color)',
                input       : 'var(--input-background-color)',
                dropdown    : 'var(--dropdown-background-color)',
                tableColumn : 'var(--table-column-background-color)',
                tableRowEven: 'var(--table-row-even-background-color)',
                tableRowOdd : 'var(--table-row-odd-background-color)',
                tableHover  : 'var(--table-hover-background-color)',
            },
            textColor      : {
                logo       : 'var(--logo-text-color)',
                header     : 'var(--header-text-color)',
                tableHeader: 'var(--table-header-text-color)',
                secondary  : 'var(--text-secondary-color)',
            },
        },
    }
};
