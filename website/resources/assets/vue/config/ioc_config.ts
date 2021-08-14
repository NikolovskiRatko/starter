import 'reflect-metadata';

import { Container } from 'inversify';

import {
  TaxonomiesInterface,
} from '../services/taxonomies';

import {
  Taxonomies,
} from '../services';

import SERVICE_IDENTIFIER from './constants/Identifiers';

const container = new Container();

container.bind<TaxonomiesInterface>(SERVICE_IDENTIFIER.TAXONOMIES).to(Taxonomies);

export default container;
