import { ComponentFixture, TestBed } from '@angular/core/testing';
import { HistoryMakanPage } from './history-makan.page';

describe('HistoryMakanPage', () => {
  let component: HistoryMakanPage;
  let fixture: ComponentFixture<HistoryMakanPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(HistoryMakanPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
