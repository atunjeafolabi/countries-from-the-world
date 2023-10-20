import type {ServerOptions} from "vue3-easy-data-table";

class CountryAPI {
    apiURL = 'http://127.0.0.1:8000/api/countries';

    async getCountries({page, rowsPerPage, sortBy, sortType}: ServerOptions) {

        let url: string = `${this.apiURL}`;

        if (page) {
            url = `${url}?page=${page}`;
        }

        if (rowsPerPage) {
            url = `${url}&limit=${rowsPerPage}`;
        }

        if (sortBy && sortType) {
            url = `${url}&sortBy=${sortBy}&sortType=${sortType}`;
        }

        const countries = (await fetch(url)).json();

        return {
            serverCurrentPageItems: Object.values((await countries).data as ICountries),
            serverTotalItemsLength: (await countries).total
        }
    }

    async getCountry(name: string) {

        const url: string = `${this.apiURL}/${name}`;
        const country = await fetch(url);

        return {
            serverCurrentPageItems: (await country.json()).data,
            serverTotalItemsLength: (await country.json()).total
        };
    }
}

interface ICountries {
    name: string,
    capital: string,
    subregion: string,
    region: string,
    flag: string
}

export default new CountryAPI();
