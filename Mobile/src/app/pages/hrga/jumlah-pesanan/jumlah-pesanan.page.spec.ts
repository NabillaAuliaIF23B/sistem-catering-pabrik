import { ComponentFixture, TestBed } from '@angular/core/testing';
import { JumlahPesananPage } from './jumlah-pesanan.page';

describe('JumlahPesananPage', () => {
  let component: JumlahPesananPage;
  let fixture: ComponentFixture<JumlahPesananPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(JumlahPesananPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
