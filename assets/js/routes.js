import React from 'react';
import {Route, Switch} from 'react-router-dom';
import CountriesList from './components/locations/CountriesList';
import Country from './components/locations/Country';

const Routes = () => (
    <Switch>
        <Route exact path={["/", "/locations/countries"]} component={CountriesList}/>
        <Route path="/locations/countries/:id" component={Country}/>
    </Switch>
);

export default Routes;
